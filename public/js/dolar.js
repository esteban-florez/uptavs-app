'use strict'
function getDolarPrice() {
  const url = document.querySelector('#serialized').dataset.dolar

  fetch(url)
    .then(response => response.json())
    .then(({ price }) => {
      localStorage.setItem('usd-price', price)
    })
    .then(() => {
      console.log("i'll try to do my best <3")
      document.querySelector('.loading-container')?.remove()
      document.querySelector('.hidden-section')?.classList?.remove('hidden-section')
    })
    .catch(err => {
      console.log(err)
      getDolarPrice()
    })
}

getDolarPrice()