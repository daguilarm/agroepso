<?php

use App\Models\Images\Image as ImageGallery;

/*
|--------------------------------------------------------------------------
| Images Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
*/

/*
| General images
*/
Route::name('dashboard.image')->get('/dashboard/image/{model}/{id}', function($model, $id) {

    //Get the image item
    $image = app(ImageGallery::class)
        ->whereModel($model)
        ->whereModelId($id)
        ->orderBy('id', 'desc')
        ->first();

    return optional($image)->file
        ? Image::make($image->file)->response()
        : Image::make('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAATlBMVEX////MzMyZmZnIyMjy8vKQkJCUlJTY2Nji4uL7+/vV1dXn5+f8/PzNzc3R0dHg4OCwsLChoaHu7u6oqKi/v7+5ubmzs7OkpKS9vb2IiIjPMQDoAAAMMUlEQVR4nO2d6XarOAyAS3AAszYkbe+8/4tOkoYgeZVtsfQc9GfuNAnos2RJNsb++DjkkEMOOeSQQw7hlFZO0m6tCqu0YmyGsu67LMsnybKur8uhGcUfZxXjUGdPIIs8PquHUWytaIy0onrAWdkwZ1ZXf8uaouqJcBCzr/6ILccyC6V7U2bluLX6PknA+wuQYkjEmyCHfbrr2HPgvSD73RlSVizmA4xZJbeGAiIHXrwX5LAXRlkuwfdkLPfASLXfq1rT/u351fZ29PPdWfpnCSqmivtegYtnsdoTqp582JSv8WiX9UMjXFaQohl6X5BqVuNRRbjyQ56Ta81HDesyZt5vlB8dDpr3wUlbDI722sRVRWdVp4ssoUXVWSG71c1oM2BiyWUv/FY2o82AeZ1ebY21hXFNM1ZmHXKmitmWYvOK5fJ+aS2NzFhItpXFRVaZCBBmH6qYb25mzFbw1MZkwHzgb9zW2BfyxdO/qYssVSAbS/qlY6rhnktWHKaqKS8Xu91d+tXdxtQp+sXuJvUsmNdLj26kIXJ3C91Urm7AXzGZcRFEPUvk/TrDU2nojQv0fd2CK1aKhsTB3rgGF11zws9QZjAj6oAreehbAT2MsyrQah66aFIyip6KOesorQHXqvKhaJ2RMS/WmodsMjmkpY2a68qmUm0LI36MiiJcfcVc42+CKFREFi3UhtsXIkPKkrbpr50gpucMw3BiV4jJAbW0Au4FMTHaWDrhpoiKTmldUe2Eqstug6jkxaSuiInugwk1NW6DqEwWJXRFJRM+Soh9INZMOqg++qx094GI51Oi/VTx0deweheIksVPcYeep2R2gWhTLkSUQS9IO7tAVBJ1jJ/iS3Tooz0g4q4Ykfdx6ZDjua09IDoVpAgOM+q02h4QcS4LDja4NOq0z/eAiIwQXLwhLze5wA4QhccKTsHB2Dj1uwPEAd0/LGNg3c3f2QEiViDkl8iE1sbZHpGmp0lQL7RHqe0RUbAJ6Im4aRyZxoFYB0rcUF1EGhG1jHPa1Y54OhdBco6bZEbjKHJOFFQTuhDlpTgFyTWKMETXWVC7+GbOrYhtIGKkEcsQZV8iw5qFDZHDiLQhBsqjhFbhclSOnkh7LI20pXg2FyKDEUlZH9XctOjEhBhpRBj5SfU37LrUDMOEGGdElL0JabUNNjofYqQR0Y39j75Ri9DXk/AgxhkRhkaC18HQFDI1wIIYZ0QUa7zBvyXHmbb5FS/iKy/eC7PidP38/Lye7v+yUF/HxixO50OxxuemKJI6W1T891tPflIQi+LnBlaBiyG/miEtVet/Tm+CPcsbTVEkdVYI4vzSyY8oPw1rUGV9PZP99+wklCHRFGrodumJkIJokfGLyugmxHWN+56C7KQzYQLih/g+u8CohPANM094hCvkPWXsTJiC+FGdKGb0ECI3dd8SmtszKQAIkxA/voxmLE4/PzO8hxBNu7g7F1TOk+4hYRpirSMWp/IR9Ycpl/oI0XjIqXVA2EWEJEQxZLevr6+b9vJXozpq8S5uPgsSIUxyzo6IeqxnNIkJSUljznaXGwpjo4o435tmw5YaIWE29A2cFEIKIhj1F+cLTFwYsQD3LgsKISprXBkRfs9XdauEJCvCGrW4gC46wKtBHkkjhB3RYZs2pPrRCIMRT+ev+XIZ/ADeh+SluCPaS1MUaHyTOjphOGJxmTW/zh8U4YSSFmrQ2NBzSRNhOOKpeLuKnP9+Bv4jaF4K85xjjAid2TvOMhEmIfZzGLrNt8mJhLBWsYeQkvQtF2EE4pwZLgZsQcuH2Dr2YApDqXe0bSaM6Ivv7D6AnvhCHCe/9RLCVG4PplAd7yUthIF58fGDd5e/gD/+a6RsbtP3/ISCEkNkSCi1EkYgTurXMFsW5/OZXHkTlUfN4J2VsxICdYip/3v6q3Ug5SeEr/VYHRBmTf/zVDvh5/wlGuI7O3zHE8IBlLVagenQP51v91IYykiIxb/p2zYjEghBmLQmRBiO/M+crIRYG5oVX33C6qYEQpgQbYRwCsM//28lvODvURCLKfteLNckEMJkbht1w6Tpn8+3Zosv5YuEiPouYr4sRiQQUrSntAKBcMpGU+eiWHGyexdPSPFASOh/gGAlnBqQNhv+Inj9YYgnbAiElL5KIGymzwNS/0SgzdjEEdriJJMNJ2XPATXq9NBJ/AkbAnOQrVj8VUKyFVciZPdSOuJKXspE2KDPaYjMkWadbNEGPF+8rJQtmDL+VLRPFRgFcRrn98tmfKaqTavAAh7b/Fu2aqNN5vgITz8TzlxYkxGZKm8bIdPYonjNIYChEBUxZfRE6WNcI+CpBb+DEW2BhmsEzDSL8R6xN8FPiW2DJ65ZDNKEnJ9wfrByhdwExJSZKNJUKNNs4uym0Igxs+EhhDTlKc1AIJwX4CGvS0FkmhFGrhw7q//U5/1jbNt4RMKsPimI0J7f+AlnI46hyxksy9/DnszYJwrTn65NCr3bp+JB5Hq6hrbnTiEEz6mHUESjowY9IXUMG1KfcgOSeUoRD4giEbmecqOvha9UQCrNniJ+0iNq2EoFh3Hg8jDvskL3qsICtFAHV8tGIXoJYU3tqsdg9eoLNR5CuK7pQ96KoBpVQ/QSwkDjGjWg7Yk9TxC9hBfoLLK/vhd3E6aKVUTvqi94FZf3CVp/pRGeTvgKcsi/r5efy/V77uNURB8hWXG0AM7TEQmEJ/9sDzEv+gjRyl/yun7PEJFCePYPM2mIPkK63vS2IBHeo0r8+4vQUflWQSN/pq5kdzN6iyMKom8le0D8gLcivo3gQzz1nqhMQOR7GwF/16kZlfCxNOZmcofmvVeDHzHgjRJfHm/IbkonfDCebmhxtyj/3f9Iz4tuQrrSHyHNEUL4hDyfrt+3PM9v39fTb/YPeL7oJETv23mnX3rqtwMJJ84iqkZ1EiKr+PMTGiM6658YQo2YOCR2EqJa019koAZxVekshFREJyH6FeGNfOTUjkEiD2Hg80WTjCGR9CEN8QcicGsP65YfFETXG5bIJKTXbImbRshbziO393SAHfFmdz68bQQFEO+lse7e6zFb+kSoG7OXBpeEIwbuU/IraAOelc90C0ZE7+VRt+AZNzRiKCI2IXlXOnSLtU9BCEPE+1eSb9JsacQgxNidsPBxFmwnEFAlABFvKBxw4AWq9CI2zkwUMiLevzJktzi8hUvgnosMQkXE+1cGnVmCjbj+eR00xCrahGpPXD3Y0BCVDaEDj53B23uuHmxIiCjMhDtal/bzdPEiNonBQjmBYIPjsT2I2EdjTkjAqWYDP/Ug9sn6KbtJb7IruQMRx9G4nD1k6ddIFMceG/iTyBEQvjrrIWBUsSGq58BFXl5ppy26og3RfGxDuCh+usUB52ZErFjKKF25+CanrRkQ1QPYEq6u+Okm0UZHLDm1qvaIaHDbBFEPBtygtvEgpgZA7XjO3SEmK6QeArbUacNusSJy9Bs1cO0KkSe8qxffESLXIZbaMaS7QWQrs7Qrb5M0dEK2a2sBleNwzGDRTypk9CU1oG4xXNQOfOUtP3TErR9nsNdXuousejC3fiw3f0fREVfsjOvc3HCXtQaMeqJYpnW1vnhP/mukDdFp911qjCO0O60RUwdDpl+sYbW8eEc07NTNKQYDLlpT6SHtkTeWm4STplJt4SBemwrgpeZvKsO98sWn/EzdIu+WCG2jgW+V+K2OF39vzN4dx954n1Wm+4yd/87IaUcz3zrZ6SHmAXfeczVw05lvsGItbPTUuwrZkB7n5JAtOWNBVsPsRY9QN6Ykj3Y0Buunh6w9s2Ax48OQZWyPHEuL+bZ5oiBtrf0LGdrisilz+wXrTaaG8LJ+Vae8H8j+2o5Db8fLlisp/GJK/5CyKxvhbn0pmrJz0m30VO+toN1VJ/2yrh6aUUhsUCnF2Ax1Z+14799v5KCzCFtUVcx5l6zrf6V7/T/hdwsPXWhiqT8YhLdOSpFlGPfD9xDhfooZw1fuwT+hWIutKDyO8m8BsVZcoXz1ntwTi6zMo4IQvK7apflmEVVC2Mn7am+9zyj3EjOiT96L2Wbn1kMiqjoj5fQnXJ7Vf8N4ishxeGC6OB+f1kPwQGRXcq8/q7LuX4XbLFnW12U1egrzvyTtvdYWYnzI/b9SbrGW85BDDjnkkEMOOeSQQzaT/wH6AJ52VgWvmQAAAABJRU5ErkJggg==')->response();
});
