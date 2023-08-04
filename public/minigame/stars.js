var SimpleStarRating = (function () {
    function SimpleStarRating(target) {
        function attr(name, d) {
            var a = target.getAttribute(name);
            return (a ? a : d);
        }

        var max = parseInt(attr('data-stars', 5)),
            disabled = typeof target.getAttribute('disabled') != 'undefined',
            defaultRating = parseFloat(attr('data-default-rating', 0)),
            currentRating = -1,
            stars = [];

        target.style.display = 'inline-block';

        for (var s = 0; s < max; s++) {
            var n = document.createElement('span');
            n.className = 'MuiRating-icon MuiRating-iconEmpty css-1xh6k8t';
            n.innerHTML = `<svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeInherit css-1cw4hi4" focusable="false" aria-hidden="true"
                 viewBox="0 0 24 24" data-testid="StarIcon">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path>
            </svg>`;
            n.addEventListener('click', starClick);
            if (s > 0)
                stars[s - 1].appendChild(n);
            else
                target.appendChild(n);

            stars.push(n);
        }

        function disable() {
            target.setAttribute('disabled', '');
            disabled = true;
        }
        this.disable = disable;

        function enable() {
            target.removeAttribute('disabled');
            disabled = false;
        }
        this.enable = enable;

        function setCurrentRating(rating) {
            currentRating = rating;
            target.setAttribute('data-rating', currentRating);
            showCurrentRating();
        }
        this.setCurrentRating = setCurrentRating;

        function setDefaultRating(rating) {
            defaultRating = rating;
            target.setAttribute('data-default-rating', defaultRating);
            showDefaultRating();
        }
        this.setDefaultRating = setDefaultRating;

        this.onrate = function (rating) {};

        target.addEventListener('mouseout', function () {
            disabled = target.getAttribute('disabled') !== null;
            if (!disabled)
                showCurrentRating();
        });

        target.addEventListener('mouseover', function () {
            disabled = target.getAttribute('disabled') !== null;
            if (!disabled)
                clearRating();
        });

        showDefaultRating();

        function showRating(r) {
            clearRating();
            for (var i = 0; i < stars.length; i++) {
                if (i >= r)
                    break;
                if (i === Math.floor(r) && i !== r)
                    stars[i].classList.add('MuiRating-iconFilled css-13m1if9');
                stars[i].classList.add('MuiRating-iconFilled css-13m1if9');
            }
        }

        function showCurrentRating() {
            var ratingAttr = parseFloat(attr('data-rating', 0));
            if (ratingAttr) {
                currentRating = ratingAttr;
                showRating(currentRating);
            } else {
                showDefaultRating();
            }
        }

        function showDefaultRating() {
            defaultRating = parseFloat(attr('data-default-rating', 0));
            showRating(defaultRating);
        }

        function clearRating() {
            for (var i = 0; i < stars.length; i++) {
                stars[i].classList.remove('active');
                stars[i].classList.remove('half');
            }
        }

        function starClick(e) {
            if (disabled) return;

            if (this === e.target) {
                var starClicked = stars.indexOf(e.target);
                if (starClicked !== -1) {
                    var starRating = starClicked + 1;
                    setCurrentRating(starRating);
                    if (typeof this.onrate === 'function')
                        this.onrate(currentRating);
                    var evt = new CustomEvent('rate', {
                        detail: starRating,
                    });
                    target.dispatchEvent(evt);
                }
            }
        }
    }

    return SimpleStarRating;
})();