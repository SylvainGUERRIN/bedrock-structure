import Turbolinks from "turbolinks"
// import "./modules/scrollreveal"
import { Flipper } from 'flip-toolkit'

const flipper = new Flipper({
    element: document,
    spring: {
        stiffness: 50,
        damping: 10
    }
})

Turbolinks.start()

const recordFlippedElements = function(){
    document.querySelectorAll('js.flip').forEach(function (element) {
        flipper.addFlipped({
            element: element,
            flipId: element.id
        })
        flipper.addInverted({
            element: element.firstElementChild,
            parent: element
        })
    })
}

document.addEventListener('turbolinks:before-render', function () {
    recordFlippedElements()
    flipper.recordBeforeUpdate()
})

document.addEventListener('turbolinks:render', function () {
    recordFlippedElements()
    flipper.update()
})
