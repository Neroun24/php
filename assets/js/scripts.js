document.addEventListener("DOMContentLoaded", function () {
  function headerBg() {
    if (window.scrollY > 22) {
      $(".header").addClass("header-bg");
    } else {
      $(".header").removeClass("header-bg");
    }
  }
  headerBg();
  window.addEventListener("scroll", headerBg);

  $(".js-nav-toggle").on("click touch", function () {
    $("body").toggleClass("nav-active");
  });
  let hashTagActive = "";
  $(document).on("click touch", ".js-nav-link", function (e) {
    $("body").removeClass("nav-active");
    if (hashTagActive != this.hash) {
      e.preventDefault();
      let dest = 0;
      if (
        $(this.hash).offset().top >
        $(document).height() - $(window).height()
      ) {
        dest = $(document).height() - $(window).height();
      } else {
        dest = $(this.hash).offset().top;
      }
      $("html, body").animate({ scrollTop: dest - 90 }, 1000, "linear");
      hashTagActive = this.hash;
    }
  });

  if ($(".js-progress-slider").length) {
    const slider = new Swiper(".js-progress-slider", {
      loop: true,
      pagination: false,
      navigation: {
        nextEl: ".js-progress__slider-next",
        prevEl: ".js-progress__slider-prev",
      },
    });
  }

  $("textarea").each(function () {
    $(this).on("keyup", function () {
      let length = $(this).val().length;
      $(this).closest(".form-group").find(".js-textarea-counter").text(length);
    });
  });

  let phoneMaskInit = false;
  function phoneMask() {
    if (phoneMaskInit) {
      return;
    }

    phoneMaskInit = true;

    $('input[type="tel"]').mask("+7 (000) 000-00-00", {
      clearIfNotMatch: true,
      placeholder: "+7 (___) ___-__-__",
    });

    $('input[type="tel"]').on("focusout blur", function () {
      $(this).valid();
    });
  }

  $('input[type="tel"]').on("focus", function () {
    phoneMask();
  });

  const stepper = $(".js-stepper");
  let stepperCurrent = 1;
  let currentStep = 1;
  let totalSteps = 5;
  let productType = $('input[name="apply_product_type"]:checked').val();

  $("[data-validate-form]").each(function () {
    $(this).validate({
      validClass: "valid",
      errorClass: "invalid",
      errorElement: "span",
      onkeyup: function (elm) {
        $(elm).valid();
        checkForm($(elm).closest("form"));
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
      invalidHandler: function (event, validator) {
        let errors = validator.numberOfInvalids();
        if (errors) {
          let message =
            errors == 1
              ? "You missed 1 field. It has been highlighted"
              : "You missed " + errors + " fields. They have been highlighted";
          console.log(message);
        }
      },
    });
  });

  if ($("#apply").length) {
    checkForm($("#apply"));
  }

  $('input[name="apply_product_type"]').on("change", function () {
    productType = $('input[name="apply_product_type"]:checked').val();
    currentStep = 1;
    stepperCurrent = 1;

    if (productType === "meat") {
      totalSteps = 4;
      stepper.attr("data-steps", 4);
    } else {
      totalSteps = 5;
      stepper.attr("data-steps", 5);
    }
  });

  $(".js-step-btn-next").on("click", function () {
    currentStep++;
    stepperCurrent = currentStep;

    setCurrentActive();
    stepperChange();
    checkStart();
    checkForm($("#apply"));
  });

  $(".js-step-btn-prev").on("click", function () {
    currentStep--;

    setCurrentActive();
    stepperChange();
    checkStart();
  });

  function setCurrentActive() {
    const current = $(
      '.step[data-step="' + currentStep + '"][data-type="' + productType + '"]'
    );

    if (currentStep === 1) {
      $('.step[data-step="1"]')
        .addClass("active")
        .siblings()
        .removeClass("active");
    } else {
      current.addClass("active").siblings().removeClass("active");
    }

    let top = $("#apply").offset().top;
    $("html, body").animate({ scrollTop: top }, 500, "swing");

    checkForm($("#apply"));
  }

  function checkEnd() {
    if (
      (currentStep === 4 && productType === "meat") ||
      (currentStep === 5 && productType === "vegs") ||
      (currentStep === 5 && productType === "fruits")
    ) {
      $(".js-step-btn-next").addClass("d-none");
      $(".js-step-btn-submit").removeClass("d-none");
      $(".js-pdn").text($(".js-pdn").attr("data-end"));
      $(".js-captcha").removeClass("d-none");
    } else {
      $(".js-step-btn-next").removeClass("d-none");
      $(".js-step-btn-submit").addClass("d-none");
      $(".js-pdn").text($(".js-pdn").attr("data-regular"));
      $(".js-captcha").addClass("d-none");
    }
  }

  function checkStart() {
    if (currentStep === 1) {
      $(".js-step-btn-prev").addClass("d-none");
    } else {
      $(".js-step-btn-prev").removeClass("d-none");
    }
  }
  checkStart();

  function stepperChange() {
    stepper.find(".stepper__item").removeClass("active");
    stepper
      .find('.stepper__item[data-step="' + currentStep + '"]')
      .addClass("active");
    stepper.attr("data-current", currentStep);
  }

  $(".js-stepper-item").on("click", function () {
    let step = +$(this).attr("data-step");
    if (step <= stepperCurrent) {
      currentStep = step;

      setCurrentActive(step);
      stepperChange();
      checkEnd();
      checkStart();
    }
  });

  let isModalOpen = false;
  $("body").on("click", function (e) {
    if (!e.target.closest(".form-submission-modal") && isModalOpen) {
      isModalOpen = false;
      $("body").removeClass("modal-open");
      $(".form-submission-modal").css("display", "none");
    }
  });

  $('[href="#consent-modal"]').on("click", function () {
    $("body").addClass("modal-open");
    $(".form-submission-modal").css("display", "");
    setTimeout(() => {
      isModalOpen = true;
    }, 0);
  });

  $(".form-submission-modal__cross").on("click", function () {
    isModalOpen = false;
    $("body").removeClass("modal-open");
    $(".form-submission-modal").css("display", "none");
  });

  function checkForm(form) {
    const acceptedDataConsent =
      form.find("[data-consent-checkbox]").is(":checked") ?? true;
    if (!acceptedDataConsent) {
      form.find('button[type="submit"]').prop("disabled", true);
      return;
    }

    if (form[0].id === "question") {
      let totalFields = form.find(".form-control[required]").length,
        validFields = form.find(".form-control[required].valid").length;

      if (validFields === totalFields) {
        form.find('button[type="submit"]').prop("disabled", false);
      } else {
        form.find('button[type="submit"]').prop("disabled", true);
      }
    }

    if (form[0].id === "apply") {
      let totalFields = form.find(
        ".step.active .form-control[required]:not(:hidden)"
      ).length,
        validFields = form.find(
          ".step.active .form-control[required].valid"
        ).length;

      if (totalFields === 0 || validFields === totalFields) {
        form.find(".js-step-btn-next").prop("disabled", false);
        form.find(".js-step-btn-submit").prop("disabled", false);
        checkEnd();
      } else {
        form.find(".js-step-btn-submit").prop("disabled", true);
        form.find(".js-step-btn-next").prop("disabled", true);
      }
    }
  }

  $(".js-toggle").on("change", function () {
    let target = $(this).attr("data-target");
    if ($(this).prop("checked")) {
      $(target).removeClass("d-none");
      $(target).find(".form-control").prop("disabled", false).focus();
    } else {
      $(target).addClass("d-none").find(".form-control").prop("disabled", true);
    }
    checkForm($("#apply"));
  });

  $("[data-consent-checkbox]").on("change", function (event) {
    checkForm($(event.target).closest("form"));
  });

  function applySuccess() {
    $(".js-stepper, .js-apply-btns, .js-apply-title").addClass("d-none");
    $(".js-apply-success").removeClass("d-none");
    $(".step.active").removeClass("active");
  }
  function questionSuccess() {
    $(".js-question-body, .js-question-success").toggleClass("d-none");
  }

  function applyNew() {
    $(".form-control.valid").each(function () {
      $(this).removeClass("valid").removeAttr("aria-invalid");
    });
    $(".js-stepper, .js-apply-btns, .js-apply-title").removeClass("d-none");
    $(".js-apply-success").addClass("d-none");
    $('.step[data-step="1"]').addClass("active");
    $("#apply").trigger("reset");
    currentStep = 1;
    stepperCurrent = 1;
    setCurrentActive();
    stepperChange();
    checkStart();
  }
  $(".js-apply-again").on("click", applyNew);

  function questionNew() {
    $(".js-question-body, .js-question-success").toggleClass("d-none");
    $(".form-control.valid").each(function () {
      $(this).removeClass("valid").removeAttr("aria-invalid");
    });
    $("#question").trigger("reset");
  }
  $(".js-question-again").on("click", questionNew);

  function getCookie(name) {
    let matches = document.cookie.match(
      new RegExp(
        "(?:^|; )" +
        name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, "\\$1") +
        "=([^;]*)"
      )
    );
    return matches ? decodeURIComponent(matches[1]) : undefined;
  }

  function setCookie(name, value, options = {}) {
    options = { path: "/", ...options };

    if (options.expires instanceof Date) {
      options.expires = options.expires.toUTCString();
    }

    let updatedCookie =
      encodeURIComponent(name) + "=" + encodeURIComponent(value);

    for (let optionKey in options) {
      updatedCookie += "; " + optionKey;
      let optionValue = options[optionKey];
      if (optionValue !== true) {
        updatedCookie += "=" + optionValue;
      }
    }

    document.cookie = updatedCookie;
  }

  const cookieBtn = document.querySelector(".js-cookie-btn");
  const cookieAlert = document.querySelector(".js-cookie-alert");
  const doesAgree = getCookie("cookieAgree") || false;

  if (doesAgree) {
    cookieAlert.classList.remove("active");
  } else {
    cookieAlert.classList.add("active");
  }
  cookieBtn.addEventListener("click", function () {
    setCookie("cookieAgree", true, {
      secure: true,
      "max-age": 31536000,
    });
    cookieAlert.classList.remove("active");
  });

  window.showSuccessModal = function () {
    document.querySelector(".snackbar")?.remove();
    document.body.insertAdjacentHTML("afterbegin", `<div class="snackbar snackbar--success">
      <h3 class="snackbar__title">Анкета отправлена</h3>
      <img class="snackbar__cross" alt="Закрыть уведомление" src="/assets/img/cross.svg" />
      <p class="snackbar__text">Анкета успешно отправлена, с вами свяжутся в ближайшее время</p>
    </div>`);

    document.querySelector(".snackbar__cross").addEventListener("click", () => {
      document.querySelector(".snackbar")?.remove();
    });
  };

  window.showFailureModal = function () {
    document.querySelector(".snackbar")?.remove();
    document.body.insertAdjacentHTML("afterbegin", `<div class="snackbar snackbar--failure">
      <h3 class="snackbar__title">Анкета</h3>
      <img class="snackbar__cross" alt="Закрыть уведомление" src="/assets/img/cross.svg" />
      <p class="snackbar__text">Сбой соединения с интернетом</p>
    </div>`);

    document.querySelector(".snackbar__cross").addEventListener("click", () => {
      document.querySelector(".snackbar")?.remove();
    });
  };
});
