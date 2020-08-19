(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["perfumedetail"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/DetallePerfumeComponent.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/DetallePerfumeComponent.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
var config = __webpack_require__(/*! ../components/Herramientas/config-vuetables-client */ "./resources/js/components/Herramientas/config-vuetables-client.js").call(undefined);

/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['detalle_perfume', 'precioMXN']
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/DetallePerfumeComponent.vue?vue&type=template&id=b47011d6&":
/*!**************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/DetallePerfumeComponent.vue?vue&type=template&id=b47011d6& ***!
  \**************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("main", { staticClass: "main" }, [
    _c("div", { staticClass: "container-fluid" }, [
      _c(
        "div",
        {
          staticClass: "modal fade",
          attrs: {
            id: "myModal",
            tabindex: "-1",
            role: "dialog",
            "aria-labelledby": "exampleModalCenterTitle",
            "aria-hidden": "true"
          }
        },
        [
          _c(
            "div",
            {
              staticClass: "modal-dialog modal-dialog-centered",
              attrs: { role: "document" }
            },
            [
              _c("div", { staticClass: "modal-content" }, [
                _vm._m(0),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "modal-body justify-content-center" },
                  [
                    _vm.detalle_perfume["id_perfume"] != undefined
                      ? _c("img", {
                          staticClass: "img-fluid rounded mx-auto d-block",
                          attrs: {
                            src:
                              "img/@articulos/" +
                              _vm.detalle_perfume["id_perfume"] +
                              ".jpg",
                            alt: "Responsive image",
                            width: "200",
                            height: "200"
                          }
                        })
                      : _vm._e(),
                    _vm._v(" "),
                    _c(
                      "p",
                      {
                        staticClass: "font-weight-bold text-center text-danger"
                      },
                      [
                        _vm._v(
                          "\n                        \t" +
                            _vm._s(_vm.detalle_perfume["nombre"]) +
                            " By " +
                            _vm._s(_vm.detalle_perfume["designer"]) +
                            "\n                        "
                        )
                      ]
                    ),
                    _vm._v(" "),
                    _c("p", { staticClass: "font-weight-bold text-center" }, [
                      _vm._v(
                        "\n                        \tContenido: \n                        \t"
                      ),
                      _c("code", { staticClass: "h5 text-danger" }, [
                        _vm._v(_vm._s(_vm.detalle_perfume["contenido"]) + "ml")
                      ])
                    ]),
                    _vm._v(" "),
                    _c("p", { staticClass: "font-weight-bold text-center" }, [
                      _vm._v(
                        "\n                        \tPrecio (Dlls.): \n                        \t"
                      ),
                      _c("code", { staticClass: "h5 text-primary" }, [
                        _vm._v("$" + _vm._s(_vm.detalle_perfume["precio_f"]))
                      ])
                    ]),
                    _vm._v(" "),
                    _c("p", { staticClass: "font-weight-bold text-center" }, [
                      _vm._v(
                        "\n                        \tPrecio (M.N.): \n                        \t"
                      ),
                      _c("code", { staticClass: "h5 text-primary" }, [
                        _vm._v("$" + _vm._s(_vm.precioMXN))
                      ])
                    ]),
                    _vm._v(" "),
                    _c(
                      "p",
                      { staticClass: "font-weight-bold text-center" },
                      [
                        _vm._v(
                          "\n                        \tPrecio imp. fronterizo: / Precio imp. al sur:\n                        \t"
                        ),
                        _c(
                          "router-link",
                          {
                            staticClass: "nav-link",
                            attrs: { to: { name: "l-contacto" } }
                          },
                          [
                            _c(
                              "button",
                              {
                                staticClass: "btn btn-link",
                                attrs: {
                                  type: "button",
                                  "data-dismiss": "modal"
                                }
                              },
                              [
                                _vm._v(
                                  "\n                        \t\t\tCONTACTANOS!\n                        \t\t"
                                )
                              ]
                            )
                          ]
                        )
                      ],
                      1
                    )
                  ]
                ),
                _vm._v(" "),
                _vm._m(1)
              ])
            ]
          )
        ]
      )
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "modal-header" }, [
      _c("h4", { staticClass: "modal-title" }, [_vm._v("Detalle de Perfume")]),
      _vm._v(" "),
      _c(
        "button",
        {
          staticClass: "close",
          attrs: { type: "button", "data-dismiss": "modal" }
        },
        [_vm._v("×")]
      )
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "modal-footer justify-content-center" }, [
      _c(
        "button",
        {
          staticClass: "btn btn-danger",
          attrs: { type: "button", "data-dismiss": "modal" }
        },
        [_vm._v("Cerrar")]
      )
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/DetallePerfumeComponent.vue":
/*!*************************************************************!*\
  !*** ./resources/js/components/DetallePerfumeComponent.vue ***!
  \*************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _DetallePerfumeComponent_vue_vue_type_template_id_b47011d6___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./DetallePerfumeComponent.vue?vue&type=template&id=b47011d6& */ "./resources/js/components/DetallePerfumeComponent.vue?vue&type=template&id=b47011d6&");
/* harmony import */ var _DetallePerfumeComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./DetallePerfumeComponent.vue?vue&type=script&lang=js& */ "./resources/js/components/DetallePerfumeComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _DetallePerfumeComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _DetallePerfumeComponent_vue_vue_type_template_id_b47011d6___WEBPACK_IMPORTED_MODULE_0__["render"],
  _DetallePerfumeComponent_vue_vue_type_template_id_b47011d6___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/DetallePerfumeComponent.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/DetallePerfumeComponent.vue?vue&type=script&lang=js&":
/*!**************************************************************************************!*\
  !*** ./resources/js/components/DetallePerfumeComponent.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_DetallePerfumeComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./DetallePerfumeComponent.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/DetallePerfumeComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_DetallePerfumeComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/DetallePerfumeComponent.vue?vue&type=template&id=b47011d6&":
/*!********************************************************************************************!*\
  !*** ./resources/js/components/DetallePerfumeComponent.vue?vue&type=template&id=b47011d6& ***!
  \********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_DetallePerfumeComponent_vue_vue_type_template_id_b47011d6___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./DetallePerfumeComponent.vue?vue&type=template&id=b47011d6& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/DetallePerfumeComponent.vue?vue&type=template&id=b47011d6&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_DetallePerfumeComponent_vue_vue_type_template_id_b47011d6___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_DetallePerfumeComponent_vue_vue_type_template_id_b47011d6___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);