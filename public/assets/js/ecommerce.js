// Scripts JavaScript personnalisés pour le module E-commerce

document.addEventListener('DOMContentLoaded', function () {
    // Exemple de fonction JS qui pourrait être utile
    // Par exemple, initialiser des tooltips Bootstrap s'ils sont utilisés
    // var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    // var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    //   return new bootstrap.Tooltip(tooltipTriggerEl)
    // })

    // La fonction fetchCartCount est déjà dans le header.blade.php car elle est critique pour l'affichage initial.
    // Si d'autres scripts globaux pour l'e-commerce sont nécessaires, ils peuvent être placés ici.

    // Gestion du clic sur les miniatures d'images produits (si présentes sur la page produit)
    const mainProductImage = document.querySelector('.product-detail-page .main-product-image');
    if (mainProductImage) {
        const thumbnailImages = document.querySelectorAll('.product-detail-page .thumbnails img');
        thumbnailImages.forEach(thumb => {
            thumb.addEventListener('click', function() {
                mainProductImage.src = this.src;
                // Optionnel: marquer la miniature active
                thumbnailImages.forEach(t => t.classList.remove('active-thumbnail', 'border-primary'));
                this.classList.add('active-thumbnail', 'border-primary');
            });
        });
    }

    // Logique pour la validation des formulaires Bootstrap (déjà dans le layout mais peut être centralisée ici si besoin)
    // (function () {
    //   'use strict'
    //   var forms = document.querySelectorAll('.needs-validation')
    //   Array.prototype.slice.call(forms)
    //     .forEach(function (form) {
    //       form.addEventListener('submit', function (event) {
    //         if (!form.checkValidity()) {
    //           event.preventDefault()
    //           event.stopPropagation()
    //         }
    //         form.classList.add('was-validated')
    //       }, false)
    //     })
    // })();

    console.log('Scripts e-commerce chargés.');
});

// Fonction globale pour mettre à jour le compteur du panier (peut être appelée par d'autres scripts si le panier est modifié par AJAX)
// Note: cette fonction est DÉJÀ dans `ecommerce.partials.header`. Si on la met ici, il faut la retirer du header.
// Pour l'instant, on la laisse dans le header pour s'assurer qu'elle est disponible dès que le header est chargé.
// function updateCartBadge() {
//     fetch('{{ route("ecommerce.cart.count") }}') // Attention: route() ne fonctionne pas dans un fichier JS pur. Passer l'URL via data-attribute ou variable globale.
//         .then(response => response.json())
//         .then(data => {
//             const cartBadge = document.querySelector('.cart-count-badge');
//             if (cartBadge) {
//                 cartBadge.textContent = data.count > 0 ? data.count : '0';
//                 cartBadge.style.display = data.count > 0 ? 'inline-block' : 'none';
//             }
//         })
//         .catch(error => console.error('Erreur lors de la récupération du nombre d\'articles du panier:', error));
// }

// Si vous prévoyez des appels AJAX pour ajouter au panier sans rechargement de page,
// vous pourriez émettre un événement personnalisé après l'ajout,
// et le header pourrait écouter cet événement pour appeler fetchCartCount.
// Exemple:
// document.addEventListener('cartItemAdded', function() {
//     // Code pour appeler fetchCartCount() ou updateCartBadge()
// });
// Et dans la fonction AJAX d'ajout au panier:
// const event = new CustomEvent('cartItemAdded');
// document.dispatchEvent(event);
