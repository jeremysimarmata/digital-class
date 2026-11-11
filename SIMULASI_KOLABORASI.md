# Panduan Simulasi Kolaborasi GitHub

Panduan ini digunakan untuk demonstrasi UTS nomor 7.

## 1. Pembagian peran

| Peran | Tanggung jawab | Bukti |
|---|---|---|
| Developer | Membuat fitur KRS, commit kode, membuka PR | Branch, commit, PR |
| Tester | Memeriksa kode dan menjalankan pengujian | Review, komentar, Checks |
| Operations | Menyiapkan repository, memeriksa pipeline dan kesiapan deployment | Actions, checklist |

Jika simulasi dilakukan sendiri, satu orang dapat memainkan beberapa peran. Jelaskan peran yang dimainkan secara jujur.

## 2. Persiapan
1. Buat repository GitHub bernama `digital-kampus-devops`.
2. Upload seluruh isi folder proyek, termasuk folder tersembunyi `.github`.
3. Buka tab Actions dan pastikan workflow `PHP CI` terdeteksi.
4. Jika ada anggota tim, tambahkan melalui Settings → Collaborators.

## 3. Operations membuat Issue
Buka Issues → New issue → Permintaan Fitur.

Judul: `[FEATURE] Tambahkan validasi pengisian KRS`

Deskripsi: Mahasiswa perlu memilih mata kuliah untuk pengajuan KRS. Sistem menolak pilihan kosong, kode mata kuliah tidak tersedia, dan total SKS lebih dari 24.

Kriteria penerimaan:
- Pengguna dapat memilih mata kuliah.
- Sistem menghitung total SKS.
- Sistem menolak pilihan kosong.
- Sistem menolak kode mata kuliah tidak dikenal.
- Sistem menolak total lebih dari 24 SKS.
- Pengujian otomatis tersedia.

Catat nomor Issue sebenarnya, misalnya `#1`.

## 4. Developer mengerjakan fitur
Clone repository, ganti USERNAME dengan akun GitHub pemilik repository:

```bash
git clone https://github.com/USERNAME/digital-kampus-devops.git
cd digital-kampus-devops
git switch -c feature/krs-registration
composer install
composer lint
composer test
```

Lalu commit dan push:

```bash
git add .
git commit -m "feat: add KRS registration validation"
git push -u origin feature/krs-registration
```

Di GitHub, buat Pull Request dari branch tersebut ke `main`. Judul PR: `feat: implement KRS registration validation`. Tulis `Closes #N` sesuai nomor Issue yang sebenarnya.

## 5. Tester melakukan review
1. Buka PR dan tab Files changed.
2. Periksa validasi pilihan kosong, kode mata kuliah, duplikasi, dan batas SKS.
3. Buka tab Checks untuk melihat GitHub Actions.
4. Jika ada masalah, berikan komentar dan minta Developer memperbaiki.
5. Jika kriteria terpenuhi dan CI berhasil, pilih Review changes → Approve.

Contoh komentar: "Saya sudah memeriksa validasi KRS dan pengujian otomatis. Kriteria penerimaan terpenuhi dan CI berhasil. Perubahan dapat disetujui."

Jangan menyetujui sebelum benar-benar memeriksa kode dan hasil tes.

## 6. Operations memeriksa hasil
1. Pastikan review disetujui.
2. Pastikan semua pemeriksaan CI berhasil.
3. Merge PR ke `main`.
4. Buka Actions untuk memastikan workflow branch utama berhasil.
5. Isi checklist pada `DEPLOYMENT_CHECKLIST.md`.

Simulasi ini berhenti pada kesiapan deployment; belum terhubung ke server cloud sungguhan.

## 7. Screenshot bukti untuk laporan
Ambil screenshot asli dari repository:
- Halaman repository dan struktur file.
- Issue fitur KRS.
- Branch Developer.
- Commit Developer.
- Pull Request yang menautkan Issue.
- Review Tester.
- GitHub Actions dengan status berhasil.
- PR yang telah di-merge ke `main`.

Jangan mengklaim langkah berhasil atau membuat screenshot bukti sebelum benar-benar dilakukan.

## 8. Kesimpulan
GitHub Issues mencatat pekerjaan, Developer mengerjakan fitur melalui branch dan Pull Request, Tester memeriksa kode serta hasil pengujian, sedangkan Operations memeriksa pipeline dan kesiapan deployment. Perubahan digabungkan ke branch utama setelah pemeriksaan dan persetujuan.
