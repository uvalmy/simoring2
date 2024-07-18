<?php

use Carbon\Carbon;

if (!function_exists('formatTanggal')) {
    function formatTanggal($tanggal = null, $format = 'l, j F Y')
    {
        $parsedDate = Carbon::parse($tanggal)->locale('id')->settings(['formatFunction' => 'translatedFormat']);
        return $parsedDate->format($format);
    }
}

if (!function_exists('statusBadge')) {
    function statusBadge($status)
    {
        if ($status == 0) {
            return '<span class="badge bg-warning">Pending</span>';
        } elseif ($status == 1) {
            return '<span class="badge bg-success">Disetujui</span>';
        } elseif ($status == 2) {
            return '<span class="badge bg-danger">Direvisi</span>';
        } else {
            return '<span class="badge bg-secondary">Unknown</span>';
        }
    }
}

if (!function_exists('formatRupiah')) {
    function formatRupiah($amount)
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}

if (!function_exists('nilaiKarakter')) {
    function nilaiKarakter()
    {
        return [
            'Religius',
            'Jujur',
            'Toleran',
            'Disiplin',
            'Bekerja Keras',
            'Kreatif Mandiri',
            'Demokratis',
            'Rasa Ingin Tahu',
            'Semangat Kebangsaan',
            'Cinta Tanah Air',
            'Menghargai Prestasi',
            'Komunikatif',
            'Gemar Membaca',
            'Peduli Lingkungan',
            'Peduli Sosial',
            'Bertanggung-jawab',
            'Cinta Damai',

        ];
    }
}