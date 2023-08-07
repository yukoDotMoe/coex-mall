<div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="autoReloadCheckbox">
        <label class="form-check-label" for="autoReloadCheckbox">
            Auto reload
        </label>
    </div>
</div>

<script>
    function getCookie(name) {
        function escape(s) { return s.replace(/([.*+?\^$(){}|\[\]\/\\])/g, '\\$1'); }
        var match = document.cookie.match(RegExp('(?:^|;\\s*)' + escape(name) + '=([^;]*)'));
        return match ? match[1] : null;
    }
    function setCookie(name,value,days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days*24*60*60*1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "")  + expires + "; path=/";
    }
    document.addEventListener('DOMContentLoaded', function () {
        const autoReloadCheckbox = document.getElementById('autoReloadCheckbox');
        let reloadTime = 10000;

        let autoReload = setTimeout(function () {
            if(!getCookie('autoReloadd_{{ Route::currentRouteName() }}')) return false;
            location.reload()
        }, reloadTime);

        if(getCookie('autoReloadd_{{ Route::currentRouteName() }}'))
        {
            autoReloadCheckbox.setAttribute('checked', true)
        }

        autoReloadCheckbox.addEventListener('change', function () {
            if (this.checked) {
                setCookie('autoReloadd_{{ Route::currentRouteName() }}', 1, 7)
                setTimeout(function () {
                    location.reload()
                }, reloadTime);
            } else {
                setCookie('autoReloadd_{{ Route::currentRouteName() }}', 0, 7)
            }
        });
    });
</script>
