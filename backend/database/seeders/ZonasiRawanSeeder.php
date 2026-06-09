<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZonasiRawanSeeder extends Seeder
{
    /**
     * Seed data zonasi rawan longsor jalur Liwa–Krui menggunakan metode Weighted Sum Overlay.
     *
     * PENTING – KONVENSI KOORDINAT SPASIAL WKT:
     * - Standar WKT POLYGON menggunakan urutan: (Longitude Latitude, ...)
     * - Poligon HARUS tertutup: koordinat pertama == koordinat terakhir
     * - SRID 4326 = WGS 84 (GPS standar)
     *
     * Zona-zona berikut menggambarkan pembagian kerawanan di sepanjang jalur
     * Krui–Liwa (TNBBS), dibagi berdasarkan kemiringan lereng, tutupan lahan,
     * jenis tanah, intensitas curah hujan, dan jarak dari sungai.
     *
     * Rentang: Lintang -5.09 s.d. -5.19 | Bujur 104.06 s.d. 104.17
     *
     * Referensi Metodologi:
     * - Metode: Weighted Sum Overlay (Σ Skor × Bobot) berbasis parameter spasial
     * - Parameter: Kemiringan lereng (DEM SRTM/DEMNAS BIG), curah hujan (BMKG),
     *              litologi (Peta Geologi PVMBG), tutupan lahan (BIG/LAPAN),
     *              jarak sesar Semangka (WCS / Peta Geologi Lembar Kotaagung)
     * - Bobot: Ditentukan dengan AHP (Saaty, 1980)
     * - Klasifikasi: Rendah / Sedang / Tinggi mengacu pada PVMBG (2018)
     * - Referensi Wilayah: Antara News, "28 Titik Rawan Longsor Liwa-Krui" (KM 248 s/d KM 271)
     */
    public function run(): void
    {
        // Bersihkan data lama sebelum seed ulang
        DB::table('zonasi_rawan')->truncate();

        $data = [
            // ─── ZONA 1: TINGGI – Inti Hutan TNBBS Segmen Barat (Lereng Terjal) ────
            // Area ini mencakup kawasan lereng terjal berbatasan langsung dengan
            // tebing curam sungai, tutupan lahan tipis akibat deforestasi parsial.
            // Skor WSO tinggi: kemiringan >40°, tanah regosol, CH >3000 mm/tahun.
            // Faktor: kemiringan >40°, litologi vulkanik labil, dekat Sesar Semangka, tutupan lahan terbuka
            [
                'geom' => DB::raw("ST_GeomFromText('POLYGON((
                    104.0700 -5.1750,
                    104.0820 -5.1750,
                    104.0970 -5.1600,
                    104.1050 -5.1450,
                    104.1100 -5.1300,
                    104.1080 -5.1150,
                    104.0950 -5.1100,
                    104.0800 -5.1200,
                    104.0680 -5.1380,
                    104.0630 -5.1560,
                    104.0660 -5.1700,
                    104.0700 -5.1750
                ))', 4326)"),
                'kelas_rawan' => 'Tinggi',
                'skor_total'  => 4.35,
                'luas_area'   => 2150.75,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],

            // ─── ZONA 2: TINGGI – Lereng Terbuka Bekas Kebun KM 8–KM 18 ────────────
            // Bagian lereng timur jalan lintas yang tanahnya terbuka karena alih
            // fungsi lahan kebun kopi. Sangat rentan terhadap longsoran tanah dangkal.
            // Skor WSO tinggi: lereng 30–50°, tanah latosol lempung, tanpa vegetasi.
            // Faktor: kemiringan 25–40°, curah hujan tinggi (>2500 mm/th berdasarkan BMKG Lampung Barat),
            //         vegetasi sebagian terbuka akibat aktivitas manusia
            [
                'geom' => DB::raw("ST_GeomFromText('POLYGON((
                    104.0900 -5.1490,
                    104.1000 -5.1490,
                    104.1080 -5.1400,
                    104.1120 -5.1280,
                    104.1100 -5.1150,
                    104.0990 -5.1100,
                    104.0880 -5.1180,
                    104.0830 -5.1320,
                    104.0850 -5.1430,
                    104.0900 -5.1490
                ))', 4326)"),
                'kelas_rawan' => 'Tinggi',
                'skor_total'  => 4.12,
                'luas_area'   => 1380.40,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],

            // ─── ZONA 3: SEDANG – Transisi Hutan-Kebun KM 18–KM 28 ─────────────────
            // Area peralihan antara hutan sekunder dan perkebunan warga.
            // Risiko sedang karena masih ada tutupan vegetasi namun lereng cukup curam.
            // Skor WSO sedang: lereng 20–35°, vegetasi campuran, tanah andosol.
            [
                'geom' => DB::raw("ST_GeomFromText('POLYGON((
                    104.1100 -5.1150,
                    104.1250 -5.1100,
                    104.1390 -5.1050,
                    104.1450 -5.0980,
                    104.1420 -5.0880,
                    104.1310 -5.0840,
                    104.1180 -5.0870,
                    104.1080 -5.0940,
                    104.1040 -5.1050,
                    104.1070 -5.1120,
                    104.1100 -5.1150
                ))', 4326)"),
                'kelas_rawan' => 'Sedang',
                'skor_total'  => 3.65,
                'luas_area'   => 1840.20,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],

            // ─── ZONA 4: SEDANG – Perbukitan Way Mengaku Utara ──────────────────────
            // Perbukitan menengah arah utara Liwa. Risiko sedang pada musim hujan
            // karena drainase buruk dan lempung ekspansif mendominasi profil tanah.
            // Faktor: kemiringan <25°, curah hujan sedang, vegetasi pantai lebih lebat
            [
                'geom' => DB::raw("ST_GeomFromText('POLYGON((
                    104.1450 -5.0980,
                    104.1570 -5.0950,
                    104.1640 -5.0900,
                    104.1660 -5.0820,
                    104.1590 -5.0770,
                    104.1490 -5.0780,
                    104.1400 -5.0830,
                    104.1360 -5.0900,
                    104.1390 -5.0960,
                    104.1450 -5.0980
                ))', 4326)"),
                'kelas_rawan' => 'Sedang',
                'skor_total'  => 3.28,
                'luas_area'   => 920.60,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],

            // ─── ZONA 5: RENDAH – Dataran Pesisir Krui Barat ────────────────────────
            // Zona datar mendekati pesisir pantai Krui. Risiko longsor rendah namun
            // tetap berpotensi banjir bandang kiriman dari lereng TNBBS di atas.
            // Skor WSO rendah: kemiringan <10°, alluvial, jarak sungai >500 m.
            [
                'geom' => DB::raw("ST_GeomFromText('POLYGON((
                    104.0620 -5.1750,
                    104.0700 -5.1750,
                    104.0660 -5.1700,
                    104.0630 -5.1560,
                    104.0600 -5.1450,
                    104.0570 -5.1580,
                    104.0560 -5.1700,
                    104.0590 -5.1790,
                    104.0620 -5.1750
                ))', 4326)"),
                'kelas_rawan' => 'Rendah',
                'skor_total'  => 2.15,
                'luas_area'   => 680.35,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],

            // ─── ZONA 6: AMAN – Dataran Permukiman Kota Liwa ────────────────────────
            // Kawasan permukiman Kota Liwa yang relatif datar, sudah terbangun.
            // Infrastruktur drainase memadai, risiko longsor sangat kecil.
            // Referensi: Ibu kota Lampung Barat (Liwa) berada pada ~-5.1492, 104.1931 (Wikipedia)
            [
                'geom' => DB::raw("ST_GeomFromText('POLYGON((
                    104.1550 -5.0980,
                    104.1660 -5.0900,
                    104.1700 -5.0820,
                    104.1680 -5.0740,
                    104.1580 -5.0710,
                    104.1480 -5.0740,
                    104.1420 -5.0810,
                    104.1440 -5.0900,
                    104.1510 -5.0960,
                    104.1550 -5.0980
                ))', 4326)"),
                'kelas_rawan' => 'Aman',
                'skor_total'  => 1.45,
                'luas_area'   => 1120.90,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ];

        foreach ($data as $row) {
            DB::table('zonasi_rawan')->insert($row);
        }
    }
}
