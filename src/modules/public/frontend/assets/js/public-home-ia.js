$(()=> {

})



$(document).ready(() => {
    const loadPreviousAnswers = () => {
        $.ajax({
            url: 'get-answers',
            method: 'GET',
            success: (res) => {
                if (res.status && Array.isArray(res.data)) {
                    // $('#chat-messages').empty(); 
                    res.data.forEach((msg) => {
                        if (msg.pergunta) {
                            renderMessage('user', msg.pergunta, formatDate(msg.created_at));
                        }
                        if (msg.resposta) {
                            renderMessage('ia', formatIAResponse(msg.resposta), formatDate(msg.created_at));
                        }
                    });
                }
                scrollToBottom();
            },
        });
    };


    const formatDate = (datetime) => {
        let date = new Date(datetime);
        let options = { day: '2-digit', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' };
        return date.toLocaleDateString('pt-BR', options);
    };

    const formatIAResponse = (text) => {
        let html = text;

        let lines = html.split("\n");

        html = lines.map(line => {
            line = line.trim();

            if (/^###\s*(.+)\s*###$/i.test(line)) {
                let title = line.match(/^###\s*(.+)\s*###$/i)[1];
                return `<h3 class="text-lg font-semibold mt-4 mb-2 text-white">${title}</h3>`;
            }

            if (/^####\s*(.+)\s*####$/i.test(line)) {
                let subtitle = line.match(/^####\s*(.+)\s*####$/i)[1];
                return `<h4 class="text-md font-semibold mt-3 mb-1 text-white">${subtitle}</h4>`;
            }

            if (/^\-\s+/.test(line)) {
                return `<li>${line.replace(/^\-\s+/, '')}</li>`;
            }

            return `<p class="mb-2 text-white">${line}</p>`;
        }).join("");

        html = html.replace(/(<li>.*<\/li>)/gs, "<ul class='list-disc ml-5 text-white'>$1</ul>");

        return html;
    };


    const renderMessage = (type, message, timestamp) => {
        let html = '';
        if (type === 'user') {
            html = `
                <div class="flex justify-end resposta-usuario">
                    <div class="max-w-md bg-blue-500 text-white rounded-2xl p-4 shadow-md">
                        <p class="text-sm font-medium">${message}</p>
                        <span class="text-xs block mt-2">Você • ${timestamp}</span>
                    </div>
                </div>
            `;
        } else if (type === 'ia') {
            html = `
                <div class="flex justify-start resposta-ia">
                    <div class="max-w-md bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-2xl p-4 shadow-md">
                        <p class="text-sm text-white dark:text-white leading-relaxed">${message}</p>
                        <span class="text-xs text-white dark:text-white block mt-2 font-medium">IA • ${timestamp}</span>
                    </div>
                </div>
            `;
        } else if (type === 'error') {
            html = `
                <div class="flex justify-start resposta-ia">
                    <div class="max-w-md bg-red-200 text-red-800 rounded-2xl p-4 shadow-md">
                        <p class="text-sm">${message}</p>
                    </div>
                </div>
            `;
        }

        $('#chat-messages').append(html);
        scrollToBottom();
    };

    const showTypingIndicator = () => {
        const typingHtml = `
            <div class="flex justify-start resposta-ia">
                <div class="max-w-md bg-gray-200 text-white rounded-2xl p-4 shadow-md typing-container">
                    <div class="typing-dots">
                        <span class="dot"></span>
                        <span class="dot"></span>
                        <span class="dot"></span>
                    </div>
                </div>
            </div>
        `;
        $('#chat-messages').append(typingHtml);
        scrollToBottom();
    };

    // Função para remover o indicador de digitação
    const removeTypingIndicator = () => {
        $('.typing-container').closest('.resposta-ia').remove();
    };

    // Função para scrollar para o final do chat
    const scrollToBottom = () => {
        $('#chat-messages').scrollTop($('#chat-messages')[0].scrollHeight);
    };

    const sendQuestionIa = (question) => {

        showTypingIndicator();

        $.ajax({
            url: 'agent-request',
            method: 'POST',
            data: { question: question },
            success: (res) => {
                removeTypingIndicator();
                loadPreviousAnswers();
            },
        });
    };

    loadPreviousAnswers();

    $('.btn-pergunta-ia').click((e) => {
        const question = $(e.currentTarget).data('option');
        if (question) {
            sendQuestionIa(question);
        }
    });
});

