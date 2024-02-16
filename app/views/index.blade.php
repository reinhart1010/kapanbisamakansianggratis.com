<!DOCTYPE html>
<html lang="id">
<?php
    $now = new DateTime();
    $target_date_iso = "2029-10-16T12:00:00+08:00";
    $target_date = new DateTime($target_date_iso);
    $diff_date = date_diff($now, $target_date);
    $diff_date_text = $diff_date->days;
    $is_passed = $diff_date->format("%R") == "-";

    if ($is_passed) {
        // Mode selebrasi
        $title = "Waktunya makan siang gratis!";
        $description = "Eh sudah jam siang di Hari Pangan Sedunia! Selamat makan!";
    } else {
        // Site Metadata
        $title = "Makan siang gratis tinggal tunggu $diff_date_text hari!";
        $description = "";
    }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, interactive-widget=resizes-content, viewport-fit=cover">
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $title }}">
    <link rel="shortcut icon" href="https://reinhart1010.id/favicon.ico" type="image/x-icon">

    <!-- TODO: Proper dynamic image for Open Graph -->

    <meta name="theme-color" content="#D0F5FF" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#002032" media="(prefers-color-scheme: dark)">

    {{-- assets() points to the public/assets folder --}}
    <link rel="stylesheet" href="/assets/css/styles.css">

    {{-- ViewsPath() points to app/views --}}
    <link rel="stylesheet" href="{{ ViewsPath('css/app.css') }}">

    <link rel="stylesheet" href="https://reinhart1010.github.io/nacelle/nacelle.lite.min.css">
    <script src="assets/js/countdown.min.js"></script>
    <script>
        /* Imperative HTML */
        var now = new Date();
        var targetDate = new Date("{{ $target_date_iso }}");

        function main() {
            // Set language to Indonesian
            countdown.setLabels(
                ' milidetik| detik| menit| jam| hari| minggu| bulan| tahun| dekade| abad| milennium',
                ' milidetik| detik| menit| jam| hari| minggu| bulan| tahun| dekade| abad| milennium',
                ' dan ',
                ', ',
                '',
                function(n){ return n.toString(); }
            );

            // Setup countdown
            countdown(
                targetDate,
                function(ts) {
                    document.getElementById("countdown").innerHTML = ts.toHTML();
                },
                countdown.YEARS|countdown.MONTHS|countdown.DAYS|countdown.HOURS|countdown.MINUTES|countdown.SECONDS
            );
        }

        window.onload = main;
    </script>
</head>

<body class="flex flex-col items-center font-sans antialiased bg-white dark:bg-black text-black dark:text-white">
    <main class="flex flex-col flex-grow items-center justify-center max-w-6xl m-safe-offset-4 px-4 py-8 gap-4 text-center">
        <div>
            <picture>
                <source srcset="https://reinhart1010.id/img/icons/shell-blue-female-neutral.jxl" type="image/jxl">
                <source srcset="https://reinhart1010.id/img/icons/shell-blue-female-neutral.avif" type="image/avif">
                <source srcset="https://reinhart1010.id/img/icons/shell-blue-female-neutral.heic" type="image/heic">
                <source srcset="https://reinhart1010.id/img/icons/shell-blue-female-neutral.webp" type="image/webp">
                <source srcset="https://reinhart1010.id/img/icons/shell-blue-female-neutral.png" type="image/png">
                <img alt="Citra Manggala D." src="https://reinhart1010.id/img/icons/shell-blue-female-neutral.png" height="932" width="713" class="h-16 w-auto">
            </picture>
        </div>
        <h1 class="font-light text-4xl">Sabar ya, kamu kemungkinan besar bisa makan siang gratis dalam <strong id="countdown" class="font-semibold"></strong>!</h1>
        <div class="flex gap-2">
            <a href="/assets/Makan%20Siang%20Gratis.ics" class="bg-rc-blue-50 dark:bg-rc-blue-900 hover:bg-white dark:hover:bg-dm-blue-800 border-inset  border-2 border-dm-blue-300 ease-out duration-200 will-change-auto hover:will-change-scroll  text-black dark:text-white  accent-gr-blue-500 dark:accent-dm-blue-400 h-min px-4 py-2 rounded-full" data-r-search-button="true">
                Tambahkan ke kalender
            </a>
            <button id="aTkd0f-share-menu-open-share-sheet" class="bg-rc-blue-50 dark:bg-rc-blue-900 hover:bg-white dark:hover:bg-dm-blue-800 border-inset  border-2 border-dm-blue-300 ease-out duration-200 will-change-auto hover:will-change-scroll  text-black dark:text-white  accent-gr-blue-500 dark:accent-dm-blue-400 h-min px-4 py-2 rounded-full" data-r-search-button="true">
                Bagikan situs ini
            </button>
        </div>
        <hr class="w-full border-black/50 dark:border-white/50" />
        <p><sup>1</sup> Berdasarkan estimasi resmi dari <strong>Tim Kemenangan Nasional (TKN) Prabowo-Gibran</strong> untuk menuntaskan program bantuan makan siang gratis sebesar 100% pada tahun 2029.</p>
        <p><sup>2</sup> <i>Countdown</i> mengacu kepada <strong>Hari Pangan Sedunia</strong> dengan asumsi kegiatan makan siang dimulai <strong>pukul 12:00 Waktu IKN (WITA)</strong>.</p>
    </main>
    <footer class="w-full p-2 pb-safe-offset-2 text-center bg-rc-blue-50 dark:bg-rc-blue-900 text-black dark:text-white">
        <p>
            <strong>Sebuah <i>Pergabutan Berkualitas</i> oleh <a href="https://reinhart1010.id/?utm_source=makansianggratis" class="underline">Reinhart Previano K.</a></strong>
        </p>
        <p>
            <a href="https://legal.reinhart1010.id/privacy/general/id" class="underline">Kebijakan Privasi</a> | <a href="https://karyakarsa.com/reinhart1010" class="underline">Donasi</a>
        </p>
    </footer>
    <script>
        function fallbackCopyTextToClipboard(text) {
            const title = "{{ $title }}", description = "{{ $description }}", url = "https://kapanbisamakansianggratis.com";
            var textArea = document.createElement("textarea");
            textArea.value = text;

            // Avoid scrolling to bottom
            textArea.style.top = "0";
            textArea.style.left = "0";
            textArea.style.position = "fixed";

            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();

            try {
                var successful = document.execCommand('copy');
                var msg = successful ? 'successful' : 'unsuccessful';
                console.log('Fallback: Copying text command was ' + msg);
            } catch (err) {
                console.error('Fallback: Oops, unable to copy', err);
            }

            document.body.removeChild(textArea);
        }

        function copyTextToClipboard(text) {
            const title = "{{ $title }}", description = "{{ $description }}", url = "https://kapanbisamakansianggratis.com";
            if (!navigator.clipboard) {
                fallbackCopyTextToClipboard(text);
                return;
            }
            navigator.clipboard.writeText(text).then(function() {
                console.log('Async: Copying to clipboard was successful!');
            }, function(err) {
                console.error('Async: Could not copy text: ', err);
            });
        }

        document.getElementById("aTkd0f-share-menu-open-share-sheet")?.addEventListener('click', () => {
            const title = "{{ $title }}", description = "{{ $description }}", url = "https://kapanbisamakansianggratis.com";
            if (navigator.share) {
                navigator.share({
                    title: title,
                    text: description,
                    url: url,
                });
            } else if (confirm("(>_ ): Mau salin tautan situs ini?")) {
                copyTextToClipboard(title + "\n\n" + description + "\n\n" + url);
            }
        });

        document.getElementById("aTkd0f-share-menu-copy-link")?.addEventListener('click', () => {
            const url = "https://kapanbisamakansianggratis.com";
            copyTextToClipboard(url);
        });
    </script>
</body>

</html>
