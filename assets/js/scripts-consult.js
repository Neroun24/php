$(async function () {
    if ($('.reviews-slider').length) {
        const swiperSlides = [...document.querySelectorAll(".swiper-slide.reviews-slider-item")];
        const shadows = [];

        const reviews = document.querySelector(".reviews");
        for (let i = 0; i < swiperSlides.length; i++) {
            reviews.insertAdjacentHTML("beforeend", `<div class="reviews-cloned-shadow">
                <div class="reviews-cloned-shadow__inner"></div>
            </div>`);
            shadows[i] = reviews.lastElementChild;
        }

        let frame;
        const container = reviews.querySelector(".swiper");

        const calculateVisibleArea = (rect, parentRect) => {
            return Math.max(0, Math.min(rect.right, parentRect.right) - Math.max(rect.left, parentRect.left));
        };

        const callback = (callNextFrame = true) => {
            let start, steps = 0;
            if (frame !== undefined) window.cancelAnimationFrame(frame);

            const step = (timeStamp) => {
                if (start === undefined) start = timeStamp;
                const elapsed = timeStamp - start;
                steps++;
                if (callNextFrame && elapsed < 300 && steps < 2500) window.requestAnimationFrame(step);

                const parentRect = container.getBoundingClientRect(),
                    reviewsRect = reviews.getBoundingClientRect(),
                    innerWidth = reviewsRect.width / 2;
                for (let i = 0; i < shadows.length; i++) {
                    const rect = swiperSlides[i].getBoundingClientRect();
                    const width = calculateVisibleArea(rect, parentRect);

                    Object.assign(shadows[i].style, {
                        width: `${width}px`,
                        height: `${rect.height}px`,
                        top: `${rect.top - reviewsRect.top}px`,
                        left: `${(rect.left - reviewsRect.left + (rect.width / 2)) < innerWidth 
                            ? rect.left + (rect.width - width)
                            : rect.left}px`
                    });
                }
            };

            frame = window.requestAnimationFrame(step);
        };

        window.addEventListener("resize", callback);
        document.addEventListener("click", () => {
            callback(false);
        });

        new Swiper('.reviews-slider-inner > .swiper', {
            slidesPerView: 1.058,
            spaceBetween: 16,
            grabCursor: true,
            autoHeight: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                596: {
                    slidesPerView: 1.27,
                },
                768: {
                    slidesPerView: 2
                }
            },
            on: {
                progress() {
                    callback();
                },
                tap() {
                    callback();
                }
            }
        });
    }

    function openModal(i) {
        const elements = $("[data-role='reviews-slider']").children();
        const parent = $(elements[i]);
        const [title] = parent.find("[data-role='reviews-slider-header']"),
            [paragraph] = parent.find("[data-role='reviews-slider-text']");
        const previous = i === 0 ? undefined : elements[i - 1];
        const next = i === elements.length - 1 ? undefined : elements[i + 1];

        $(`
        <div class="review-modal" data-role="review-modal-window">
            <h3 class="review-modal__heading">${title.innerHTML}</h3>
            <button class="review-modal__cross" data-role="review-modal-close-button">
                <img class="review-modal__cross-image" src="img/icons/cross.svg" alt="Закрыть модальное окно" />
            </button>
            <p class="review-modal__text"></p>
            ${previous && next ? `<div class="review-modal__buttons">
                <button class="review-modal__button review-modal__button--grey" data-role="review-modal-back">Назад</button>
                <button class="review-modal__button review-modal__button--red" data-role="review-modal-next">Далее</button>
            </div>` : `
                ${previous ? `<button class="review-modal__button review-modal__button--grey" data-role="review-modal-back">Назад</button>` : ""}
                ${next ? `<button class="review-modal__button review-modal__button--red" data-role="review-modal-next">Далее</button>` : ""}
            `}
        </div>`).appendTo("body");
        $(".review-modal__text").html(paragraph.innerHTML);

        $('[data-role="review-modal-close-button"]').on("click", function () {
            $("body").removeClass("modal-open");
            $('[data-role="review-modal-window"]').remove();
        });

        $('[data-role="review-modal-back"]').on("click", function () {
            $('[data-role="review-modal-window"]').remove();
            openModal(i - 1);
        });

        $('[data-role="review-modal-next"]').on("click", function () {
            $('[data-role="review-modal-window"]').remove();
            openModal(i + 1);
        });

        $("body").addClass("modal-open");
    }

    $("[data-role='reviews-slider-modal']").each(function (i) {
        $(this).on("click", function () {
            openModal(i);
        });
    });

    $("body").on("click", function (e) {
        if (!e.target.closest(".review-modal") && !e.target.closest("[data-role='reviews-slider-modal']") && $('[data-role="review-modal-window"]')[0]) {
            $("body").removeClass("modal-open");
            $('[data-role="review-modal-window"]').remove();
        }
    });

    $(".consult-form .custom-select").select2?.({
        allowClear: true,
        dropdownCssClass: "custom-select-dropdown",
        dropdownParent: $(".consult-form"),
    });

    $("#footerConsultingForm").validate({
        validClass: "valid",
        errorClass: "invalid",
        errorElement: "span",
        onkeyup: function (elm) {
            $(elm).valid();
            const [form] = $(elm).closest("form");
            form.setAttribute("novalidate", "novalidate");
            form.querySelector("[data-consent-checkbox]").required = false;
        },
        submitHandler: function (form, event) {
            event.preventDefault();
            if ($(form).attr("id") === "apply") applySuccess();
            if ($(form).attr("id") === "question") questionSuccess();

            form.removeAttribute("novalidate");
            form.querySelector("[data-consent-checkbox]").required = true;
            document.onSubmit = (e) => {
                e.preventDefault();
                return false;
            };

            form.reportValidity();
            if (form.checkValidity()) {
                form.setAttribute("novalidate", "novalidate");
                form.querySelector("[data-consent-checkbox]").required = false;

                fetch(form.action, {
                    method: "POST",
                    body: new FormData(form)
                }).then(async (result) => {
                    const body = await result.json();
                    if (body.success) {
                        window.showSuccessModal();
                    } else window.showFailureModal();
                }).catch((e) => {
                    console.trace(e);
                    window.showFailureModal();
                });
            }
        },
    });

    $("#footerConsultingForm").find("select").on("change", (e) => {
        const form = e.target.closest("form");
        form.setAttribute("novalidate", "novalidate");
        form.querySelector("[data-consent-checkbox]").required = false;
    });

    $("#footerConsultingForm").find("input").on("change", (e) => {
        const form = e.target.closest("form");
        form.setAttribute("novalidate", "novalidate");
        form.querySelector("[data-consent-checkbox]").required = false;
    });

    const ANIMATION_LENGTH = 2;
    const DELAY = 2;

    let isAnimating = false;

    function startVideoPlay(providedHls = undefined) {
        isAnimating = false;

        if (Hls.isSupported()) {
            const video = document.getElementById("consulting-video");
            let hls = providedHls ?? new Hls({ startPosition: 0.001 });

            video.ontimeupdate = async () => {
                if (!isAnimating && video.duration - video.currentTime <= ANIMATION_LENGTH + DELAY) {
                    isAnimating = true;
                    const newVideo = video.cloneNode(true);
                    newVideo.id = "";
                    newVideo.classList.add("consult-intro__video--appearing");
                    newVideo.removeAttribute("poster");
                    const tempHls = new Hls({ startPosition: 0.001 });
                    tempHls.loadSource(newVideo.dataset.src);
                    tempHls.attachMedia(newVideo);

                    await new Promise((resolve) => setTimeout(resolve, DELAY * 1000));
                    video.after(newVideo);
                    newVideo.play();
                    await new Promise((resolve) => setTimeout(resolve, ANIMATION_LENGTH * 1000));
                    video.remove();
                    newVideo.id = "consulting-video";

                    hls.destroy();
                    startVideoPlay(tempHls);
                }
            };

            if (!providedHls) {
                hls.loadSource(video.dataset.src);
                hls.attachMedia(video);
                video.play();
            }
        }
    }

    startVideoPlay();


    const {
        areas,
        categories,
        forms,
        vectors
    } = await fetch("/ajax/centers/getFilter.php").then((response) => response.json());

    function initAutocompleteInput(selectorName, selectorLabel) {
        console.log('dfklgjdfkjgjndfjknjkdfgnkdfgn');

        const selector = $(selectorName);

        $.widget("custom.autocompleteInput" + selectorLabel, $.ui.autocomplete, {
            _renderItem: function (ul, item) {
                return $("<li>")
                    .addClass(selector[0].value === item.label && "active")
                    .append(item.label)
                    .appendTo(ul);
            }
        });

        $("#question_form_country")["autocompleteInput" + selectorLabel]({
            appendTo: $("#question_form_country").parent(),
            minLength: 0,
            source: areas.map((area) => area.name),
            delay: 0,
            open: function () {
                selector.parent().addClass("open");
            },
            close: function () {
                selector.parent().removeClass("open");
            },
            change: function () {
                const input = $(selectorName);
                if (input[0].value.length) {
                    input.parent().addClass("not-empty");
                } else input.parent().removeClass("not-empty");
            },
        });

        selector
            .parent()
            .find("button")
            .on("click", function () {
                selector.val("");
                selector.trigger("change");
                $(selectorName).parent().removeClass("not-empty");
            });

        selector.on("focus", function () {
            selector.trigger("input");
        });
    }

    initAutocompleteInput("#question_form_country", "Country");
});
