const ratio = .1
const options = {
    root: null,
    rootMargin: '0px',
    threshold: ratio
}

const handleIntersect = function (entries, observer) {
    entries.forEach(function (entry) {
        if (entry.intersectionRatio > ratio) {
            entry.target.classList.add('in')
            if (entry.target.dataset.delay) {
                entry.target.style.transitionDelay = `.${entry.target.dataset.delay}s`
            }
            entry.target.classList.remove('reveal')
            observer.unobserve(entry.target)
        }
    })
}
const observer = new IntersectionObserver(handleIntersect, options)

document.documentElement.classList.add('reveal-loaded')
window.addEventListener('DOMContentLoaded', function () {
    const observer = new IntersectionObserver(handleIntersect, options)
    document.querySelectorAll('.reveal').forEach(function (r) {
        observer.observe(r)
    })
})

// document.addEventListener('turbolinks:render', function () {
//     document.querySelectorAll('.fade').forEach(function (r) {
//         observer.observe(r)
//     })
// })

document.addEventListener('turbolinks:before-render', function () {
    observer.takeRecords()
})
