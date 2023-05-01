import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ["collectionContainer"]

    static values = {
        index    : Number,
        prototype: String,
    }

    connect() {
        super.connect();
        this.collectionContainerTarget.querySelectorAll('li').forEach(li => this.addTagFormDeleteLink(li))
    }

    addCollectionElement(event)
    {
        const item = document.createElement('li');
        item.innerHTML = this.prototypeValue.replace(/__name__/g, this.indexValue);
        this.collectionContainerTarget.appendChild(item);
        this.addTagFormDeleteLink(item);
        this.indexValue++;
    }

    addTagFormDeleteLink(item)
    {
        const removeFormButton = document.createElement('button');
        removeFormButton.innerText = 'Supprimer';

        item.append(removeFormButton);

        removeFormButton.addEventListener('click', (e) => {
            e.preventDefault();
            item.remove();
        });
    }
}