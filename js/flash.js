document.querySelectorAll('.toast')
.forEach(function (toastNode) {
  let toast = new bootstrap.Toast(toastNode, {
    // autohide: false
  })
  toast.show()
})