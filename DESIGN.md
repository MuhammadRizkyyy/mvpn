# DESIGN.md — MVP.N Design System

**Muda Visioner Penggerak Nasional** (MVP.N) — komunitas non-profit yang lahir di Sukabumi (2023) untuk memberdayakan pemuda Indonesia agar terlibat aktif dalam pembangunan nasional. Tagline: *"Terbang Tinggi & Sentuh Langit."*

Sistem desain ini menerjemahkan identitas itu — kepulauan Indonesia yang membentang dari Sabang sampai Merauke, semangat merah-putih, dan cita-cita generasi muda yang "menyentuh langit" — menjadi warna, tipografi, dan komponen yang konsisten di seluruh situs.

---

## 1. Konsep & Rasionalisasi

| Elemen visual saat ini | Makna | Arahan desain |
|---|---|---|
| Peta Indonesia grayscale + dot berdenyut (`peta.png`, section Beranda) | Titik-titik pulau yang tersambung, gerakan pemuda yang menyala dari satu titik | Warna aksen **emas/amber** untuk titik terang di atas peta gelap — merepresentasikan cita-cita yang menyala di tengah kepulauan |
| "Muda Visioner Penggerak Nasional" | Nasionalisme, kepemudaan, gerakan | **Merah** (semangat, berani bertindak) dari bendera nasional sebagai warna primer |
| Kepulauan dikelilingi laut | Konektivitas, kedalaman, kepercayaan, jangkauan nasional (mendorong kerja sama pemerintah/swasta) | **Navy/ocean blue** sebagai warna sekunder — struktur, kredibilitas, formal |
| "Sentuh Langit" | Aspirasi, harapan, masa depan cerah | **Amber/gold** sebagai warna aksen — dipakai tipis, untuk CTA dan highlight, bukan warna dominan |
| Konten saat ini (hitam/putih, `#000`/`#fff`/`#333`) | Netral, editorial, serius | Dipertahankan sebagai basis netral situs — warna bangsa & aspirasi masuk sebagai aksen, bukan mengganti seluruh palet |

Prinsip: **archipelago-neutral base + flag-red primary + ocean-navy secondary + aspiration-gold accent.** Base netral (putih/hitam/abu) tetap dominan untuk keterbacaan konten panjang (Tentang, Proker, Struktur); warna bangsa dipakai untuk elemen yang butuh perhatian (CTA, hero, active states, badge).

---

## 2. Palet Warna

### 2.1 Primary — Merah Nusantara (semangat, aksi)
Dipakai untuk: tombol utama (submit kerjasama), link aktif alternatif, badge penting, hover state pada elemen interaktif utama.

| Token | Hex | Pemakaian |
|---|---|---|
| `--color-primary-50` | `#FDECEC` | Background lembut, alert info ringan |
| `--color-primary-100` | `#F9C7C7` | Hover background tipis |
| `--color-primary-300` | `#E4696B` | Border/aksen sekunder |
| `--color-primary-500` | `#CE1126` | **Primary base** — merah bendera Indonesia |
| `--color-primary-600` | `#B00E20` | Hover state tombol primary |
| `--color-primary-700` | `#8C0B19` | Active/pressed state |
| `--color-primary-900` | `#4E0610` | Teks di atas background terang, aksen gelap |

### 2.2 Secondary — Navy Nusantara (laut, kepercayaan, struktur)
Dipakai untuk: header/footer alternatif, section Struktur & Kemitraan, background hero peta (`.global-map`), elemen formal/pemerintahan.

| Token | Hex | Pemakaian |
|---|---|---|
| `--color-navy-50` | `#EAF0F6` | Background section terang bernuansa laut |
| `--color-navy-100` | `#C3D3E3` | Card border, divider |
| `--color-navy-300` | `#5C7A9B` | Teks sekunder di atas background gelap |
| `--color-navy-500` | `#12233B` | **Secondary base** — background hero/peta, footer |
| `--color-navy-700` | `#0A1526` | Overlay gelap peta, background gambar |
| `--color-navy-900` | `#05090F` | Hitam kebiruan — pengganti `#000` polos di section peta |

### 2.3 Accent — Emas Aspirasi (cita-cita, "sentuh langit")
Dipakai **tipis**: dot berdenyut di peta, garis bawah judul (title-line), badge "coming soon" versi aktif, ikon pencapaian, hover pada CTA sekunder. Jangan dipakai sebagai warna body text atau background luas.

| Token | Hex | Pemakaian |
|---|---|---|
| `--color-gold-100` | `#FBEFD2` | Background highlight lembut |
| `--color-gold-400` | `#E8B84B` | Hover/tipis |
| `--color-gold-500` | `#D4A017` | **Accent base** — pulsing dot, underline aktif, ikon bintang/pencapaian |
| `--color-gold-600` | `#B3830D` | Teks aksen di atas putih (butuh kontras, cek AA) |

### 2.4 Netral (basis konten — dipertahankan dari situs saat ini)

| Token | Hex | Pemakaian |
|---|---|---|
| `--color-neutral-white` | `#FFFFFF` | Background utama section |
| `--color-neutral-50` | `#F8F9FA` | Background alternatif (card, accordion aktif) |
| `--color-neutral-100` | `#F2F2F2` | Placeholder gambar, skeleton |
| `--color-neutral-300` | `#D9D9D9` | Border ringan |
| `--color-neutral-500` | `#777777` | Teks tersier (caption, meta) — dipakai di `.member-info p` |
| `--color-neutral-600` | `#555555` | Body text — `.tentang-text` |
| `--color-neutral-800` | `#333333` | Heading — `.tentang-title` |
| `--color-neutral-950` | `#111111` | Teks tegas/hitam pekat |

### 2.5 Semantic

| Token | Hex | Pemakaian |
|---|---|---|
| `--color-success` | `#1E8E5A` | Overlay sukses form kerjasama (ganti biru Bootstrap default) |
| `--color-error` | `#CE1126` | Sama dengan primary — validasi form |
| `--color-warning` | `#D4A017` | Sama dengan accent gold |
| `--color-info` | `#12233B` | Sama dengan navy |

> Catatan migrasi: saat ini `.success-card`, `.checkmark`, dan `.btn-submit:hover` memakai biru Bootstrap default (`#0d6efd`). Ganti ke `--color-primary-500` (merah) atau `--color-success` (hijau) agar konsisten dengan palet — biru tidak punya makna dalam sistem ini.

### Kontras & Aksesibilitas
- `primary-500` (`#CE1126`) di atas putih: rasio kontras ~5.5:1 — aman untuk teks besar/tombol, gunakan teks putih di atasnya.
- `gold-500` di atas putih hanya ~2.3:1 — **jangan** dipakai sebagai teks kecil di atas putih; gunakan hanya sebagai elemen dekoratif/ikon, atau `gold-600` untuk teks dengan ukuran ≥18px.
- `navy-500`/`navy-700` di atas putih: kontras tinggi, aman untuk teks dan background gelap dengan teks putih.

---

## 3. Tipografi

Situs saat ini memakai **Poppins** (dideklarasikan via `.font` di `index1.blade.php`) dan **Figtree** (default Tailwind/Laravel Breeze di `tailwind.config.js`). Konsolidasikan menjadi dua peran jelas:

| Peran | Font | Alasan |
|---|---|---|
| **Display / Heading** (hero title, judul section, angka) | **Poppins** (600–800) | Geometris, tegas, modern — cocok untuk judul besar seperti "MUDA VISIONER PENGGERAK NASIONAL" |
| **Body / UI** (paragraf, label form, navigasi) | **Figtree** (400–600) | Humanis, tinggi keterbacaan di teks panjang (Tentang, Proker) — sudah jadi default Tailwind di proyek ini |

### Skala tipografi (selaras dengan `clamp()` yang sudah dipakai di CSS)

| Token | Ukuran | Weight | Contoh pemakaian |
|---|---|---|---|
| `--text-hero` | `clamp(36px, 6vw, 64px)` | 800 | `.map-title` (hero peta) |
| `--text-h1` | `clamp(1.8rem, 5vw, 3rem)` | 700 | `.tentang-title`, `.visimisi-title`, judul section |
| `--text-h2` | `clamp(1.3rem, 3.5vw, 1.8rem)` | 700 | `.visimisi-heading`, sub-judul kartu |
| `--text-body-lg` | `clamp(1rem, 2.2vw, 1.2rem)` | 400 | `.tentang-text` |
| `--text-body` | `clamp(0.95rem, 2vw, 1.1rem)` | 400 | `.visimisi-text`, paragraf umum |
| `--text-caption` | `0.85rem–0.95rem` | 400–600 | `.soon`, meta info, label kecil |
| `--text-eyebrow` | `clamp(12px, 2.5vw, 18px)`, letter-spacing lebar, uppercase | 600 | `.map-subtitle` — dipakai untuk tagline/label kategori |

**Aturan:** heading section (`h1`, `h2` di setiap `<section>`) selalu Poppins bold; isi paragraf & UI selalu Figtree. Jangan campur Poppins untuk body text panjang — melelahkan mata pada teks justified seperti `.tentang-text`.

---

## 4. Penerapan pada Section yang Ada

- **Hero/Beranda (`.global-map`)** — background diganti dari `#000` polos menjadi `--color-navy-900` → `--color-navy-700` (gradient tipis), overlay peta tetap grayscale. Pulsing dot (`.global-map::after`) diganti dari putih polos menjadi `--color-gold-500` dengan glow (`box-shadow`) warna gold — dot ini menjadi elemen "sentuh langit" yang menyala di atas kepulauan.
- **Tentang** — tetap netral (`neutral-800`/`neutral-600`), tanpa perubahan warna besar; ini section naratif yang butuh keterbacaan maksimal.
- **Visi & Misi** — `.visimisi-box` boleh mendapat aksen garis kiri tipis (`border-left: 4px solid var(--color-primary-500)`) untuk kartu Visi, dan `var(--color-navy-500)` untuk kartu Misi — membedakan dua kartu secara visual sekaligus menegaskan tema merah (aksi/visi) vs navy (struktur/misi terorganisir).
- **Struktur** — `.accordion-button:not(.collapsed)` memakai `--color-navy-50` sebagai background aktif (bukan abu netral polos), memberi identitas "formal/institusional" pada bagian struktur organisasi.
- **Proker** — checklist `::before` (centang) memakai `--color-primary-500` alih-alih hitam — menegaskan proker sebagai "aksi/gerakan".
- **Galeri/Dokumentasi** — tetap netral (kartu putih, shadow lembut) agar foto dokumentasi jadi fokus utama, bukan warna UI.
- **Kemitraan** — netral, logo mitra tampil natural (grayscale → warna saat hover, sudah ada).
- **Kerjasama (form)** — `.btn-submit` dan `.success-card`/`.checkmark` beralih dari biru Bootstrap (`#0d6efd`) ke `--color-primary-500`/`--color-success` sesuai §2.5.
- **Navbar** — `.nav-link.active::after` dan underline hover boleh beralih dari hitam (`#000`) ke `--color-primary-500` agar status "sedang di section ini" terasa hidup, bukan sekadar garis netral.

---

## 5. Spacing, Radius & Shadow (dari pola CSS yang sudah konsisten di proyek)

| Token | Nilai | Sumber |
|---|---|---|
| `--radius-card` | `14px` | `.member-card`, `.gallery-card` |
| `--radius-card-lg` | `18px` | `.partnership-card`, `.success-card` |
| `--radius-pill` | `50%` | `.ig-btn`, dot peta |
| `--shadow-card` | `0 6px 18px rgba(0,0,0,0.08)` | `.member-card` |
| `--shadow-card-hover` | `0 14px 30px rgba(0,0,0,0.15)` | hover state kartu |
| `--shadow-elevated` | `0 15px 40px rgba(0,0,0,0.1)` | `.partnership-card` |

Pertahankan pola ini — sudah konsisten di seluruh `index1.blade.php`. Saat menambah komponen baru, gunakan salah satu token di atas, jangan buat nilai shadow/radius baru secara ad-hoc.

---

## 6. Implementasi (Tailwind + CSS Variables)

Tambahkan token warna ke `tailwind.config.js` agar bisa dipakai via utility class (`bg-primary-500`, `text-navy-700`, dll) di markup baru, sambil CSS custom yang sudah ada di `index1.blade.php` tetap memakai CSS variables:

```js
// tailwind.config.js — theme.extend.colors
colors: {
    primary: {
        50: '#FDECEC', 100: '#F9C7C7', 300: '#E4696B',
        500: '#CE1126', 600: '#B00E20', 700: '#8C0B19', 900: '#4E0610',
    },
    navy: {
        50: '#EAF0F6', 100: '#C3D3E3', 300: '#5C7A9B',
        500: '#12233B', 700: '#0A1526', 900: '#05090F',
    },
    gold: {
        100: '#FBEFD2', 400: '#E8B84B', 500: '#D4A017', 600: '#B3830D',
    },
},
fontFamily: {
    sans: ['Figtree', ...defaultTheme.fontFamily.sans],
    display: ['Poppins', ...defaultTheme.fontFamily.sans],
},
```

Untuk CSS lama (inline `<style>` di Blade), definisikan variable global sekali di `resources/css/app.css` atau `:root` pada `header.blade.php`:

```css
:root {
    --color-primary-500: #CE1126;
    --color-navy-500: #12233B;
    --color-navy-900: #05090F;
    --color-gold-500: #D4A017;
    --color-neutral-600: #555555;
    --color-neutral-800: #333333;
}
```

---

## 7. Checklist Konsistensi

- [ ] Warna biru Bootstrap default (`#0d6efd`) tidak dipakai lagi di luar dependency Bootstrap itu sendiri (form-control focus ring boleh tetap default).
- [ ] Semua CTA utama (submit, link "Bergabung", dsb.) memakai `--color-primary-500`.
- [ ] Warna gold hanya untuk elemen dekoratif/aksen kecil (dot, underline, ikon), tidak untuk body text atau background luas.
- [ ] Heading section pakai Poppins, body/paragraf pakai Figtree.
- [ ] Radius & shadow baru merujuk token di §5, bukan nilai baru.
