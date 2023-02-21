import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
    static targets = [ "quantity" ]

    remove(event) {
        fetch(
            '/cart/'+event.params.productid,
            {
                method: 'DELETE'
            }
        )
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            let cartHeaderController = this.application.getControllerForElementAndIdentifier(document.querySelector('[data-controller="cartheader"]'), 'cartheader');
            cartHeaderController.setQuantity(data.totalQuantity);
        });
    }

    increment(event) {
        fetch(
            '/cart/'+event.params.productid+'/increment',
            {
                method: 'POST'
            }
        )
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            let cartHeaderController = this.application.getControllerForElementAndIdentifier(document.querySelector('[data-controller="cartheader"]'), 'cartheader');
            cartHeaderController.setQuantity(data.totalQuantity);
            this.targetQuantity.textContent = data.rowQuantity;
        });
    }
}