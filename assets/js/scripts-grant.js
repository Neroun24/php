$(async function () {
  $(".grants-form .custom-select").select2?.({
    allowClear: true,
    dropdownCssClass: "custom-select-dropdown",
    dropdownParent: $(".grants-form"),
  });

  $("#resetGrantsButton").css("display", "none");
  $("#grantsDocuments").css("display", "none");

  $("#resetGrantsButton").on("click", function () {
    $("#grantsDocuments").css("display", "none");
    $("#grantsDescription").css("display", "");
    $("#resetGrantsButton").css("display", "none");
    $("#grantsDescriptionCentreBlock").remove();

    $(".custom-select").val("");
    $(".custom-select").trigger("change");
  });

  let innerDocumentsPages = [];
  let currentPage = 0;

  function updateDocuments() {
    const grantsDocuments = document.querySelector("#grantsDocuments");
    grantsDocuments.textContent = "";
    const splicedVisibleDocuments = visibleDocuments.reduce(function (d, n) {
      return d[d.length - 1]?.length === 5
        ? [...d, [n]]
        : [...d.slice(0, -1), [...(d[d.length - 1] ?? []), n]];
    }, []);

    splicedVisibleDocuments[currentPage].forEach((document, i) => {
      const splicedDocuments = document.docs.reduce(function (d, n) {
        return d[d.length - 1]?.length === 4
          ? [...d, [n]]
          : [...d.slice(0, -1), [...(d[d.length - 1] ?? []), n]];
      }, []);

      grantsDocuments.insertAdjacentHTML(
        "beforeend",
        `
        <div class="grants-description grants-description--documents">
            <div class="grants-description__description-block">
                <h3 class="grants-description__heading">
                ${document.name}
                </h3>
                <p class="grants-description__paragraph">
                ${document.short_text}
                </p>
                <p
                class="grants-description__paragraph grants-description__paragraph--accented"
                >
                Главные условия
                </p>
                <p class="grants-description__paragraph pb-1 pb-md-0">
                ${document.main_text}
                </p>
            </div>
            <div class="order-1 flex-grow-1">
                <h4 class="grants-description-documents__heading">Документы</h4>
                <ul class="grants-description-documents">
                    ${splicedDocuments[innerDocumentsPages[i]]
          .map(
            ({ path, name }) => `
                        <li class="grants-description-document">
                            <div class="grants-description-document__info-wrap">
                            <div class="grants-description-document__icon-wrap">
                                <img
                                src="/assets/img/icons/document-icon.svg"
                                alt="Иконка Документа"
                                />
                            </div>
                            <p class="grants-description-document__text">
                                ${name}
                            </p>
                            </div>
                            <a class="grants-description-document__button" href="${path}" target="_blank">
                              Скачать
                            </a>
                        </li>
                    `
          )
          .join("\n")}
                </ul>
                ${splicedDocuments.length > 1
          ? `<ul class="grants-description-pagination">
                    ${Array.from(
            { length: splicedDocuments.length },
            (_, j) =>
              `<li data-id="${j}" class="grants-description-pagination__page ${j === innerDocumentsPages[i] ? 'grants-description-pagination__page--active' : ''}">${j + 1
              }</li>`
          ).join("\n")}
                </ul>`
          : ""
        }
            </div>
        </div>`
      );

      [
        ...grantsDocuments.lastElementChild.querySelectorAll(
          ".grants-description-pagination__page"
        ),
      ].forEach((e) =>
        e.addEventListener("click", (e) => {
          if (
            e.target.dataset.right !== undefined ||
            e.target.parentNode.dataset.right !== undefined
          ) {
            innerDocumentsPages[i]++;
          } else if (
            e.target.dataset.left !== undefined ||
            e.target.parentNode.dataset.left !== undefined
          ) {
            innerDocumentsPages[i]--;
          } else {
            innerDocumentsPages[i] = Number(e.target.dataset.id);
          }

          updateDocuments();
        })
      );
    });

    if (splicedVisibleDocuments.length > 1) {
      grantsDocuments.insertAdjacentHTML(
        "beforeend",
        `
        <ul class="grants-description-pagination">
          ${Array.from(
          { length: splicedVisibleDocuments.length },
          (_, i) =>
            `<li data-id="${i}" class="grants-description-pagination__page ${i === currentPage ? 'grants-description-pagination__page--active' : ""}">${i + 1
            }</li>`
        ).join("\n")}
        </ul>`
      );

      [
        ...grantsDocuments.lastElementChild.querySelectorAll(
          ".grants-description-pagination__page"
        ),
      ].forEach((e) =>
        e.addEventListener("click", (e) => {
          if (
            e.target.dataset.right !== undefined ||
            e.target.parentNode.dataset.right !== undefined
          ) {
            currentPage++;
          } else if (
            e.target.dataset.left !== undefined ||
            e.target.parentNode.dataset.left !== undefined
          ) {
            currentPage--;
          } else {
            currentPage = Number(e.target.dataset.id);
          }

          updateDocuments();
        })
      );
    }
  }

  $("#openModal").on("click", function () {
    $("body").addClass("modal-open");
    $(".grants-modal").css("display", "");
  });

  $("#closeModal").on("click", function () {
    $("body").removeClass("modal-open");
    $(".grants-modal").css("display", "none");
  });

  const {
    areas,
    categories,
    forms,
    vectors
  } = await fetch("/ajax/centers/getFilter.php").then((response) => response.json());

  const grantsFormSelect = document.getElementById("grants-form-select"),
    grantsVectorSelect = document.getElementById("grants-vector-select"),
    radios = document.getElementById("grants-form-radios"),
    grantsCityInput = document.getElementById("question_form_country");
  grantsFormSelect.innerHTML = `<option></option>${forms.map((form) => `<option value="${form.id}">${form.name}</option>`).join("")}`;
  grantsVectorSelect.innerHTML = `<option></option>${vectors.map((vector) => `<option value="${vector.id}">${vector.name}</option>`).join("")}`;

  radios.innerHTML = categories.map((category, i) => `
  <div class="col-12 col-lg">
    <label class="form-check radio radio-btn">
      <input
        class="form-check-input"
        type="radio"
        name="product_type"
        value=${category.id}
        ${i === 0 ? "checked" : ""}
      /><span class="form-check-name">${category.name}</span>
    </label>
  </div>`).join("");

  $("#grantsForm").validate({
    validClass: "valid",
    errorClass: "invalid",
    errorElement: "span",
    submitHandler: async function (form, event) {
      event.preventDefault();

      const body = {
        category: Number(radios.querySelector("input[type='radio']:checked").value),
        area: Number(areas.find((area) => area.name === grantsCityInput.value).id),
        form: Number(grantsFormSelect.options[grantsFormSelect.selectedIndex].value),
        vector: Number(grantsVectorSelect.options[grantsVectorSelect.selectedIndex].value)
      };

      let hadError = false;
      const result = await fetch("/ajax/centers/getCenters.php", {
        method: "POST",
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(body)
      }).then((response) => response.json()).catch((e) => {
        console.trace(e);
        hadError = true;
      });

      if (hadError) return;
      currentPage = 0;

      $(".support-centre").remove();
      $("#grantsDescription").css("display", "none");
      $("#resetGrantsButton").css("display", "");
      $("#grantsDocuments").css("display", "");

      visibleDocuments = result.items;
      const centre = result.rootCenter;
      $("#grantsForm")[0].insertAdjacentHTML("afterend", `<div class="support-centre" id="grantsDescriptionCentreBlock">
        <h3 class="support-centre__title">${centre.name}</h3>
        <a href="${centre.link}" target="_blank" class="support-centre__button">Перейти</a>
      </div>`);

      innerDocumentsPages = Array.from(
        { length: visibleDocuments.length },
        () => 0
      );

      updateDocuments();
    },
    rules: {
      city_autocomplete: {
        required: true,
        normalizer: function(value) {
          return areas.some((area) => area.name === value) ? value : "";
        }
      }
    }
  });

  $("body").on("click", function (e) {
    if (!e.target.closest(".grants-modal") && e.target.id !== "openModal" && $(".grants-modal")[0]) {
      $("body").removeClass("modal-open");
      $(".grants-modal").css("display", "none");
    }
  });

  function initAutocompleteInput(selectorName, selectorLabel) {
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
