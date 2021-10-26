document.addEventListener('DOMContentLoaded', () => {
  const flashMessage = document.getElementById('flash-message')

  if (flashMessage) {
    setTimeout(() => {
      const body = document.querySelector('body')
      body.removeChild(flashMessage)
    }, 5000)
  }
})
