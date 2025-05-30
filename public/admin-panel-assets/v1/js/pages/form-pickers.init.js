!function (i) {
    "use strict";

    function e() {
    }

    e.prototype.init = function () {
        i("#basic-datepicker").flatpickr(), i("#datetime-datepicker").flatpickr({
            enableTime: !0,
            dateFormat: "Y-m-d H:i"
        }), i("#humanfd-datepicker").flatpickr({
            altInput: !0,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d"
        }), i("#minmax-datepicker").flatpickr({
            minDate: "2020-01",
            maxDate: "2020-03"
        }), i("#disable-datepicker").flatpickr({
            onReady: function () {
                this.jumpToDate("2025-01")
            }, disable: ["2025-01-10", "2025-01-21", "2025-01-30", new Date(2025, 4, 9)], dateFormat: "Y-m-d"
        }), i("#multiple-datepicker").flatpickr({
            mode: "multiple",
            dateFormat: "Y-m-d"
        }), i("#conjunction-datepicker").flatpickr({
            mode: "multiple",
            dateFormat: "Y-m-d",
            conjunction: " :: "
        }), i("#range-datepicker").flatpickr({mode: "range"}), i("#inline-datepicker").flatpickr({inline: !0}), i("#basic-timepicker").flatpickr({
            enableTime: !0,
            noCalendar: !0,
            dateFormat: "H:i"
        }), i("#24hours-timepicker").flatpickr({
            enableTime: !0,
            noCalendar: !0,
            dateFormat: "H:i",
            time_24hr: !0
        }), i("#minmax-timepicker").flatpickr({
            enableTime: !0,
            noCalendar: !0,
            dateFormat: "H:i",
            minDate: "16:00",
            maxDate: "22:30"
        }), i("#preloading-timepicker").flatpickr({
            enableTime: !0,
            noCalendar: !0,
            dateFormat: "H:i",
            defaultDate: "01:45"
        }), i("#basic-colorpicker").colorpicker(), i("#hexa-colorpicker").colorpicker({format: "auto"}), i("#component-colorpicker").colorpicker({format: null}), i("#horizontal-colorpicker").colorpicker({horizontal: !0}), i("#inline-colorpicker").colorpicker({
            color: "#DD0F20",
            inline: !0,
            container: !0
        }), i(".clockpicker").clockpicker({donetext: "Done"}), i("#single-input").clockpicker({
            placement: "bottom",
            align: "left",
            autoclose: !0,
            default: "now"
        }), i("#check-minutes").click(function (e) {
            e.stopPropagation(), i("#single-input").clockpicker("show").clockpicker("toggleView", "minutes")
        })
    }, i.FormPickers = new e, i.FormPickers.Constructor = e
}(window.jQuery), function () {
    "use strict";
    window.jQuery.FormPickers.init()
}();