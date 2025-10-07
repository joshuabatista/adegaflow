<?php

require __DIR__ . '../../../../../public_html/config/conection.php';
require __DIR__ . '../../../../../app/functions.php';
require __DIR__ . '/public-send-email.php';

$pdo->beginTransaction();

$email = $_POST['email'] ?? null;

if($email == "false"){
    $pdo->rollback();
    response([
        'status'=>false,
        'message'=>'Preencha o email'
    ]);
}

$sql = "SELECT adega_id, email FROM adega";

$query = prepareAll($sql);

$emailsBanco = $query->data;

$emailsDecrypt = [];

foreach ($emailsBanco as $emailObj) {
    if (isset($emailObj->email)) {
        $decryptedEmail = decryptData($emailObj->email, $key);
        $emailsDecrypt[] = [
            'adega_id' => $emailObj->adega_id,
            'email' => $decryptedEmail
        ];
    }
}

$adega_id = null; 

foreach ($emailsDecrypt as $item) {
    if ($item['email'] === $email) {
        $adega_id = $item['adega_id'];
        break;
    }
}

if ($adega_id === null) {
    $pdo->rollback();
    response([
        'status' => false,
        'message' => 'Email não encontrado'
    ]);
}

$verificationCode = random_int(100000, 999999);

$currentTimestamp = time();

$expirationTimestamp = $currentTimestamp + (5 * 60);

$expirationDateTime = date('Y-m-d H:i:s', $expirationTimestamp);

$sql = "INSERT INTO password_reset_codes SET 
        adega_id = ?,
        code = ?,
        expires_at = ?";

$columns = [
    $adega_id,
    $verificationCode,
    $expirationDateTime
];

$query = prepare($sql, $columns);  

if(!empty($query->exception)){
    $pdo->rollback();
    response([
        'status'=>false,
        'message'=>'Erro ao redefinir senha. Contate o suporte tecnico.'
    ]);
}

$assunto = "Codigo de verificacao - AdegaFlow";

$logoPath = __DIR__ . '/../../../../../public_html/assets/images/AF_Just_Logo.svg';

$logoSrc = '/assets/images/AF_Just_Logo.svg';

if (file_exists($logoPath) && ($data = @file_get_contents($logoPath))) {
    $logoSrc = 'data:image/svg+xml;base64,' . base64_encode($data);
}

$mensagem = <<<HTML
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>Recuperação de senha — AdegaFlow</title>
</head>
<body style="margin:0; padding:0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial; background:#f3f4f6;">
  <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="min-width:320px;">
    <tr>
      <td align="center" style="padding:32px 16px;">
        <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="width:100%; max-width:600px;">
          <tr>
            <td style="background:#ffffff; border-radius:12px; padding:24px; box-shadow:0 12px 40px rgba(43,45,62,0.12);">
              <div style="padding:18px; border-radius:10px; background:transparent; color:#111827;">

                <h1 style="margin:0 0 12px; font-size:20px; color:#343e59; text-align:left;">
                  Recuperação de senha
                </h1>

                <p style="margin:0 0 14px; color:#374151; line-height:1.5;">
                  Olá,
                </p>

                <p style="margin:0 0 18px; color:#374151; line-height:1.5;">
                  Recebemos uma solicitação para redefinir a sua senha. Use o código abaixo para criar uma nova senha. Esse código é válido por <strong>5 minutos</strong>.
                </p>

                <div style="margin:18px 0; text-align:center;">
                  <div style="display:inline-block; padding:18px 22px; border-radius:12px; background:#2b2d3e; box-shadow:0 8px 24px rgba(43,45,62,0.18);">
                    <div style="font-family:monospace, ui-monospace, SFMono-Regular, Menlo, Monaco, 'Courier New', monospace; font-size:28px; letter-spacing:4px; color:#ffffff; font-weight:700;">
                      {$verificationCode}
                    </div>
                  </div>
                </div>

                <p style="margin:0 0 10px; color:#374151; line-height:1.5;">
                  Se você não solicitou a alteração, ignore este e-mail. O código será invalidado após 5 minutos.
                </p>

                <p style="margin:18px 0 0; color:#6b7280; font-size:13px;">
                  Dúvidas ou suporte: <a href="mailto:adegaflowservice@gmail.com" style="color:#343e59; text-decoration:none;">adegaflowservice@gmail.com</a>
                </p>

                <hr style="border:none; border-top:1px solid #eef2ff; margin:20px 0;" />

                <p style="margin:0; font-size:12px; color:#9ca3af;">
                  (Não responda a este e-mail automaticamente gerado.)<br/>
                  AdegaFlow — Gestão de adegas | <span style="color:#9ca3af;">Protegemos seus dados</span>
                </p>

              </div>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
HTML;

$email = enviarEmail($email, '', $assunto, $mensagem);

$pdo->commit();

response([
    'status'=>true,
    'message'=>'E-mail enviado com sucesso! Verifique sua caixa de E-mail!'
]);