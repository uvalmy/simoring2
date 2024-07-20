<?php

use Carbon\Carbon;
use App\Models\Pengaturan;

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

if (!function_exists('getPengaturan')) {
    function getPengaturan()
    {
        return Pengaturan::first();
    }
}

if (!function_exists('getPredikat')) {
    function getPredikat($nilai)
    {
        if ($nilai >= 86 && $nilai <= 100) {
            return 'Amat Baik';
        } elseif ($nilai >= 70 && $nilai <= 85) {
            return 'Baik';
        } elseif ($nilai < 70) {
            return 'Kurang';
        } else {
            return 'Nilai tidak valid';
        }
    }
}

if (!function_exists('compressImage')) {
    function compressImage($source_image, $compress_image)
    {
        $image_info = getimagesize($source_image);
        if ($image_info['mime'] == 'image/jpeg' || $image_info['mime'] == 'image/jpg' ) {
            $source_image_resource = imagecreatefromjpeg($source_image);
            imagejpeg($source_image_resource, $compress_image, 10);
        } elseif ($image_info['mime'] == 'image/png') {
            $source_image_resource = imagecreatefrompng($source_image);
            imagepng($source_image_resource, $compress_image, 9);
        }
        return $compress_image;
    }
}
