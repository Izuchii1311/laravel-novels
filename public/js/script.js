// Show Password
function showPassword(passwordFieldId, iconId) {
  const onPassword = document.getElementById(passwordFieldId);
  const iconPass = document.getElementById(iconId);

  const type = onPassword.getAttribute('type') === 'password' ? 'text' : 'password';
  onPassword.setAttribute('type', type);

  iconPass.classList.toggle('fa-eye');
  iconPass.classList.toggle('fa-eye-slash');
}

// Automatically Hide Alert
setTimeout(function() {
  let alert = document.querySelector('.alert');
  alert.remove();
}, 5000);