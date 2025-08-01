function showLottieToast({ message = "Mensagem", type = "success", duration = 4000 }) {
  return new Promise((resolve) => {
    const animations = {
      success: "public_html/assets/images/AF_Success.mp4",
      error:   "public_html/assets/images/AF_Error.mp4",
      warning: "public_html/assets/images/AF_Warning.mp4",
    };
    const animSrc = animations[type] || animations.success;
    const isVideo = animSrc.endsWith('.mp4');
    const toast = document.createElement('div');
    toast.className = "flex items-center bg-white shadow-lg rounded-xl p-4 w-80 gap-4 animate-slide-in transition-all duration-500 ease-in-out";
    
    const animationHTML = isVideo
      ? `<video autoplay muted playsinline loop style="width: 50px; height: 50px; object-fit: contain;">
           <source src="${animSrc}" type="video/mp4">
         </video>`
      : `<lottie-player src="${animSrc}" background="transparent" speed="1"
           style="width: 50px; height: 50px;" autoplay>
         </lottie-player>`;
    
    toast.innerHTML = `
      ${animationHTML}
      <span class="text-gray-800 text-sm font-medium">${message}</span>
    `;
    document.getElementById("toastContainer").appendChild(toast);
    
    // entra e sai, e só aí resolve a Promise
    setTimeout(() => {
      toast.classList.remove('animate-slide-in');
      toast.classList.add('animate-slide-out');
      setTimeout(() => {
        toast.remove();
        resolve(); // <— libera o then()
      }, 400); // deve bater com o tempo de slide-out
    }, duration);
  });
}

/**
 * Abre um modal “clean” usando Lottie/video e botões de confirmação/cancelamento.
 * @param {Object} options
 * @param {string} options.title      — Título do modal
 * @param {string} options.html       — Conteúdo em HTML (mensagem)
 * @param {"success"|"error"|"warning"} options.type
 * @param {string} options.confirmText
 * @param {string} options.cancelText
 * @returns {Promise<true|false>} resolve(true) se confirmar, resolve(false) se cancelar/fechar
 */
function showLottieModal({
  title = '',
  html = '',
  type = 'success',
  confirmText = 'OK',
  cancelText = 'Cancelar'
}) {
  return new Promise(resolve => {
    // overlay com menos opacidade
    const overlay = document.createElement('div');
    overlay.className = `
      fixed inset-0 bg-black/20 backdrop-blur-sm flex items-center justify-center z-50
    `;

    const box = document.createElement('div');
    box.className = `
      bg-white rounded-xl shadow-2xl p-6 max-w-sm w-full
      flex flex-col items-center gap-4
    `;

    if (title) {
      const h2 = document.createElement('h2');
      h2.className = 'text-lg font-semibold text-gray-800 text-center';
      h2.innerText = title;
      box.appendChild(h2);
    }

    const animations = {
      success: "public_html/assets/images/AF_Success.mp4",
      error:   "public_html/assets/images/AF_Error.mp4",
      warning: "public_html/assets/images/AF_Warning.mp4",
    };
    const animSrc = animations[type] || animations.success;
    const isVideo = animSrc.endsWith('.mp4');
    const animWrapper = document.createElement('div');
    animWrapper.innerHTML = isVideo
      ? `<video autoplay muted playsinline loop style="width: 80px; height: 80px; object-fit: contain;">
           <source src="${animSrc}" type="video/mp4">
         </video>`
      : `<lottie-player src="${animSrc}" background="transparent" speed="1"
           style="width: 80px; height: 80px;" autoplay>
         </lottie-player>`;
    box.appendChild(animWrapper);

    const content = document.createElement('div');
    content.className = 'text-gray-700 text-sm text-center';
    content.innerHTML = html;
    box.appendChild(content);

    const footer = document.createElement('div');
    footer.className = 'mt-4 flex gap-3';

    const btnCancel = document.createElement('button');
    btnCancel.className = 'px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 text-gray-800 font-medium';
    btnCancel.innerText = cancelText;
    btnCancel.onclick = () => {
      document.body.removeChild(overlay);
      resolve(false);
    };

    const btnConfirm = document.createElement('button');
    btnConfirm.className = 'px-4 py-2 bg-emerald-500 rounded hover:bg-emerald-600 text-white font-medium';
    btnConfirm.innerText = confirmText;
    btnConfirm.onclick = () => {
      document.body.removeChild(overlay);
      resolve(true);
    };

    footer.appendChild(btnCancel);
    footer.appendChild(btnConfirm);
    box.appendChild(footer);

    overlay.appendChild(box);
    document.body.appendChild(overlay);
  });
}