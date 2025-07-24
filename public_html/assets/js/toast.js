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
