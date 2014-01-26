/**
 * Created with JetBrains WebStorm.
 * User: LEEYOOL
 * Date: 8/25/13
 * Time: 1:39 PM
 * To change this template use File | Settings | File Templates.
 */

;(function(window) {

    'useMap strick';

    var document = window.document,
        docElem = document.documentElement;


    function extend(a, b) {
        for (var key in b) {
            if(b.hasOwnProperty(key)) {
                a[key] = b[key];
            }
        }

        return a;
    }


    // from https://github.com/ryanve/response.js/blob/master/response.js
    function gerViewortH() {
        var client = docElem['clientHeight'],
            inner = window['innerHeight'];

        if(client < inner) {
            return inner;
        } else {
            return client;
        }
    }

    function getOffset(el){
        return el.getBoundingClientRect();
    }

    function isMouseLeaveorEnter (e, handler) {
        if (e.type != 'mouseout' && e.type != 'mouseover') return false;
        var reltg = e.relatedTarget ? e.relatedTarget :
            e.type == 'mouseout' ? e.toElement : e.fromElement;

        while (reltg && reltg != handler) {
            reltg = reltg.parentNode;
        }

        return (reltg != handler);
    }

    function cbpTooltipMenu(el, options) {
        this.el = el;
        this.option = extend(this.defaults, options);
        this._init();
    }

    cbpTooltipMenu.prototype = {
        defaults : {
            //add a time out to avoid the menu to open instanly
            delayMenu : 100
        },

        _init : function () {
            this.touch = Modernizr.touch;
            this.menuItems = document.querySelectorAll('#' + this.el.id + ' > li');
            this._iniEvents();
        },

        _iniEvents : function () {
            var self = this;

            Array.prototype.slice.call(this.menuItems).forEach(function (el, i) {
                var trigger = el.querySelector('a');
                if (self.touch) {
                    trigger.addEventListener('click', function(ev) {
                        self._handleClick(this, ev);
                    });
                } else {
                    trigger.addEventListener('click', function (ev) {
                        if (this.parentNode.querySelector('ul.cbp-tm-menu')) {
                            ev.preventDefault();
                        }
                    });

                    el.addEventListener('mouseover', function(ev) {
                        if(isMouseLeaveorEnter(ev, this)){
                            self._openMenu(this);
                        }
                    });

                    el.addEventListener('mouseout', function(ev) {
                        if(isMouseLeaveorEnter(ev, this)){
                            self._closeMenu(this);
                        }
                    });
                }
            });
        },

        _openMenu : function (el) {

            var self = this;
            clearTimeout(this.omtimeout);
            this.omtimeout = setTimeout(function () {
                var submenu = el.querySelector('ul.cbp-tm-submenu');

                if(submenu) {
                    el.className = 'cbp-tm-show';
                    if (self._positionMenu(el) === 'top') {

                    }
                }
            })

        },

        _closeMenu : function (el) {

        },

        _handleClick : function (el, ev) {

        },

        _positionMenu : function (el) {

        }

    };
});




















