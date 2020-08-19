(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["AdminG"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/AdmonGeneral/AdmonGeneralComponent.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/AdmonGeneral/AdmonGeneralComponent.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************************/
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
var AdmonH = function AdmonH(r) {
  return __webpack_require__.e(/*! require.ensure | Admon */ "Admon").then((function () {
    return r(__webpack_require__(/*! ./AdmonHiltonComponent.vue */ "./resources/js/components/AdmonGeneral/AdmonHiltonComponent.vue"));
  }).bind(null, __webpack_require__)).catch(__webpack_require__.oe);
};

var PdvH = function PdvH(r) {
  return __webpack_require__.e(/*! require.ensure | Pdv */ "Pdv").then((function () {
    return r(__webpack_require__(/*! ./PuntoVentaHiltonComponent.vue */ "./resources/js/components/AdmonGeneral/PuntoVentaHiltonComponent.vue"));
  }).bind(null, __webpack_require__)).catch(__webpack_require__.oe);
};

/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      admin: false,
      pdv: true
    };
  },
  components: {
    'adminhilton': AdmonH,
    'puntoventa': PdvH
  },
  computed: {//
  },
  methods: {
    getData: function getData(id) {
      var me = this;

      if (id == 0) {
        this.admin = false;
        this.pdv = true;
      } else {
        this.admin = true;
        this.pdv = false;
      }
    }
  },
  mounted: function mounted() {//this.getData();
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/AdmonGeneral/AdmonGeneralComponent.vue?vue&type=template&id=64372e39&":
/*!*************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/AdmonGeneral/AdmonGeneralComponent.vue?vue&type=template&id=64372e39& ***!
  \*************************************************************************************************************************************************************************************************************************************/
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
  return _c(
    "div",
    { staticClass: "container", attrs: { id: "top" } },
    [
      _c("div", { staticClass: "row justify-content-center" }, [
        _c(
          "div",
          {
            staticClass: " d-flex justify-content-center text-warning",
            staticStyle: { "background-color": "#1c2a48" }
          },
          [
            _c(
              "div",
              {
                staticClass:
                  "d-flex justify-content-end form-inline text-warning"
              },
              [
                _c(
                  "div",
                  {
                    staticClass:
                      "d-flex justify-content-end form-inline text-warning"
                  },
                  [
                    _c(
                      "a",
                      {
                        staticClass: "btn btn-flat text-warning",
                        on: {
                          click: function($event) {
                            return _vm.getData(0)
                          }
                        }
                      },
                      [
                        _c("i", { staticClass: "fas fa-cash-register" }),
                        _vm._v(" Punto de Venta\n                        ")
                      ]
                    )
                  ]
                ),
                _vm._v(" "),
                _c(
                  "div",
                  {
                    staticClass:
                      "d-flex justify-content-end form-inline text-warning"
                  },
                  [
                    _c(
                      "a",
                      {
                        staticClass: "btn btn-flat text-warning",
                        on: {
                          click: function($event) {
                            return _vm.getData(1)
                          }
                        }
                      },
                      [
                        _c("i", { staticClass: "fas fa-cogs" }),
                        _vm._v(" Administración\n                        ")
                      ]
                    )
                  ]
                )
              ]
            )
          ]
        )
      ]),
      _vm._v(" "),
      _c("adminhilton", {
        directives: [
          {
            name: "show",
            rawName: "v-show",
            value: _vm.admin,
            expression: "admin"
          }
        ]
      }),
      _vm._v(" "),
      _c("puntoventa", {
        directives: [
          { name: "show", rawName: "v-show", value: _vm.pdv, expression: "pdv" }
        ]
      })
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/AdmonGeneral/AdmonGeneralComponent.vue":
/*!************************************************************************!*\
  !*** ./resources/js/components/AdmonGeneral/AdmonGeneralComponent.vue ***!
  \************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _AdmonGeneralComponent_vue_vue_type_template_id_64372e39___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./AdmonGeneralComponent.vue?vue&type=template&id=64372e39& */ "./resources/js/components/AdmonGeneral/AdmonGeneralComponent.vue?vue&type=template&id=64372e39&");
/* harmony import */ var _AdmonGeneralComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./AdmonGeneralComponent.vue?vue&type=script&lang=js& */ "./resources/js/components/AdmonGeneral/AdmonGeneralComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _AdmonGeneralComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _AdmonGeneralComponent_vue_vue_type_template_id_64372e39___WEBPACK_IMPORTED_MODULE_0__["render"],
  _AdmonGeneralComponent_vue_vue_type_template_id_64372e39___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/AdmonGeneral/AdmonGeneralComponent.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/AdmonGeneral/AdmonGeneralComponent.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************!*\
  !*** ./resources/js/components/AdmonGeneral/AdmonGeneralComponent.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AdmonGeneralComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./AdmonGeneralComponent.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/AdmonGeneral/AdmonGeneralComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AdmonGeneralComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/AdmonGeneral/AdmonGeneralComponent.vue?vue&type=template&id=64372e39&":
/*!*******************************************************************************************************!*\
  !*** ./resources/js/components/AdmonGeneral/AdmonGeneralComponent.vue?vue&type=template&id=64372e39& ***!
  \*******************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AdmonGeneralComponent_vue_vue_type_template_id_64372e39___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./AdmonGeneralComponent.vue?vue&type=template&id=64372e39& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/AdmonGeneral/AdmonGeneralComponent.vue?vue&type=template&id=64372e39&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AdmonGeneralComponent_vue_vue_type_template_id_64372e39___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AdmonGeneralComponent_vue_vue_type_template_id_64372e39___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);