<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TitikLongsorSeeder extends Seeder
{
    /**
     * Seed data titik historis kejadian longsor di jalur Liwa–Krui (TNBBS, Lampung Barat).
     *
     * PENTING – KONVENSI KOORDINAT SPASIAL:
     * - Standar WKT (Well-Known Text) menggunakan urutan: POINT(Longitude Latitude)
     * - Contoh: POINT(104.1082 -5.1324) → Bujur=104.1082, Lintang=-5.1324
     * - ST_AsGeoJSON() di controller juga mengembalikan [Lng, Lat], yang sudah
     *   ditangani dengan benar oleh frontend (const [lng, lat] = coordinates).
     * - SRID 4326 = WGS 84 (GPS standar internasional)
     *
     * Sumber koordinat: titik-titik representatif sepanjang Jalan Lintas Barat
     * Sumatera (Krui – Liwa) yang menembus kawasan TNBBS, Lampung.
     * Rentang: Lintang -5.09 s.d. -5.18 | Bujur 104.06 s.d. 104.17
     *
     * Referensi Kejadian:
     * [1] Kupas Tuntas, "Longsor di Jalur Krui-Liwa KM 16", 11 Mei 2026
     * [2] Antara News, "BPJN tangani 5 titik longsor ruas Liwa-Krui", Juli 2025
     * [3] Media Lampung / BPBD Lampung Barat, September 2025
     * [4] BPBD Pesisir Barat, "Longsor Pal 5 Talangbaru Waykrui", 30 September 2025
     * [5] Antara News, "28 Titik Rawan Longsor Liwa-Krui" → KM 248+150 s/d KM 271+350
     */
    public function run(): void
    {
        // Bersihkan data lama sebelum seed ulang untuk menghindari duplikasi
        DB::table('titik_longsor')->truncate();

        $data = [
            // ─── TITIK 1: KM 22 Segmen Atas – Zona Tebing Terjal ───────────────────
            [
                'koordinat'        => DB::raw("ST_GeomFromText('POINT(104.1082 -5.1324)', 4326)"),
                'lokasi_detail'    => 'Kawasan Hutan Lindung TNBBS – Jalur Lintas Barat KM 22',
                'tingkat_kerusakan'=> 'Berat',
                'tanggal_kejadian' => '2025-12-14',
                'foto_kondisi'     => 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?q=80&w=600',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            // ─── TITIK 2: Tikungan Pal 8 – Pekon Labuhan Mandi ─────────────────────
            [
                'koordinat'        => DB::raw("ST_GeomFromText('POINT(104.0945 -5.1412)', 4326)"),
                'lokasi_detail'    => 'Tikungan Pal 8 (Pekon Labuhan Mandi) – Lereng Tebing Luar',
                'tingkat_kerusakan'=> 'Sedang',
                'tanggal_kejadian' => '2026-01-20',
                'foto_kondisi'     => 'https://images.unsplash.com/photo-1582298538104-fc2c0a5a0027?q=80&w=600',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            // ─── TITIK 3: Jembatan Dua – Tebing Batu Sungai Way Batang ─────────────
            [
                'koordinat'        => DB::raw("ST_GeomFromText('POINT(104.1215 -5.1201)', 4326)"),
                'lokasi_detail'    => 'Tebing Batu Sungai Way Batang – Jembatan Dua Jalur Krui-Liwa',
                'tingkat_kerusakan'=> 'Berat',
                'tanggal_kejadian' => '2026-02-05',
                'foto_kondisi'     => 'https://images.unsplash.com/photo-1578328819058-b69f3a3b0f6b?q=80&w=600',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            // ─── TITIK 4: Gapura Perbatasan Pesisir Barat – Lampung Barat ───────────
            [
                'koordinat'        => DB::raw("ST_GeomFromText('POINT(104.1390 -5.1115)', 4326)"),
                'lokasi_detail'    => 'Sekitar Gapura Perbatasan Pesisir Barat–Lampung Barat (KM 30)',
                'tingkat_kerusakan'=> 'Ringan',
                'tanggal_kejadian' => '2026-03-10',
                'foto_kondisi'     => 'https://images.unsplash.com/photo-1547683905-f686c993aae5?q=80&w=600',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            // ─── TITIK 5: Kawasan Atas Liwa – Way Mengaku ───────────────────────────
            [
                'koordinat'        => DB::raw("ST_GeomFromText('POINT(104.1652 -5.0948)', 4326)"),
                'lokasi_detail'    => 'Jalan Utama Way Mengaku – Kawasan Perbukitan Atas Liwa',
                'tingkat_kerusakan'=> 'Sedang',
                'tanggal_kejadian' => '2026-04-18',
                'foto_kondisi'     => 'https://images.unsplash.com/photo-1616431575958-941b37c97c80?q=80&w=600',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            // ─── TITIK 6: Turunan Curam KM 17 – Menuju Krui ─────────────────────────
            [
                'koordinat'        => DB::raw("ST_GeomFromText('POINT(104.0760 -5.1550)', 4326)"),
                'lokasi_detail'    => 'Turunan Curam KM 17 – Arah Pesisir Krui (Lereng Luar TNBBS)',
                'tingkat_kerusakan'=> 'Berat',
                'tanggal_kejadian' => '2025-11-03',
                'foto_kondisi'     => 'https://images.unsplash.com/photo-1604537529428-15bcbeecfe4d?q=80&w=600',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            // ─── TITIK 7: Persimpangan Pekon Cahaya Negeri ──────────────────────────
            [
                'koordinat'        => DB::raw("ST_GeomFromText('POINT(104.1040 -5.1470)', 4326)"),
                'lokasi_detail'    => 'Persimpangan Pekon Cahaya Negeri – Lereng Terbuka Bekas Kebun',
                'tingkat_kerusakan'=> 'Ringan',
                'tanggal_kejadian' => '2025-10-22',
                'foto_kondisi'     => 'https://images.unsplash.com/photo-1547683905-f686c993aae5?q=80&w=600',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            // ─── TITIK 8: Ruas Jalan Berkelok KM 10 (Bukit Pematang Sari) ───────────
            [
                'koordinat'        => DB::raw("ST_GeomFromText('POINT(104.0870 -5.1650)', 4326)"),
                'lokasi_detail'    => 'Bukit Pematang Sari – Ruas Jalan Berkelok KM 10 Dekat Sungai',
                'tingkat_kerusakan'=> 'Sedang',
                'tanggal_kejadian' => '2025-09-15',
                'foto_kondisi'     => 'https://images.unsplash.com/photo-1582298538104-fc2c0a5a0027?q=80&w=600',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            // ─── TITIK 9: Tepi Tebing Sungai Way Besay (KM 27) ──────────────────────
            [
                'koordinat'        => DB::raw("ST_GeomFromText('POINT(104.1310 -5.1050)', 4326)"),
                'lokasi_detail'    => 'Tepi Tebing Sungai Way Besay – KM 27 Dekat Tubing Wisata',
                'tingkat_kerusakan'=> 'Berat',
                'tanggal_kejadian' => '2025-08-07',
                'foto_kondisi'     => 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?q=80&w=600',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            // ─── TITIK 10: Area Perkebunan Terdeforestasi (KM 13) ───────────────────
            [
                'koordinat'        => DB::raw("ST_GeomFromText('POINT(104.0955 -5.1580)', 4326)"),
                'lokasi_detail'    => 'Area Perkebunan Terdeforestasi KM 13 – Lereng Barat TNBBS',
                'tingkat_kerusakan'=> 'Ringan',
                'tanggal_kejadian' => '2025-07-25',
                'foto_kondisi'     => 'https://images.unsplash.com/photo-1547683905-f686c993aae5?q=80&w=600',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
        ];

        foreach ($data as $row) {
            DB::table('titik_longsor')->insert($row);
        }
    }
}
