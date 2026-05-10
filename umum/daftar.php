<?php
include '../admin/koneksi.php';

// Ambil data profil sekolah
$query = mysqli_query($conn, "SELECT * FROM profil LIMIT 1");
$profil = mysqli_fetch_assoc($query);

include 'header.php';
?>

<style>
    .bg-pastel-green {
        background-color: #77dd77;
    }

    .btn-daftar {
        background-color: #ff9a9e;
        color: white;
        border-radius: 10px;
        font-weight: bold;
        transition: 0.3s;
        border: none;
    }

    .btn-daftar:hover {
        background-color: #fecfef;
        color: #ff9a9e;
    }

    .rounded-4 {
        border-radius: 1.2rem !important;
    }
</style>

<div class="container my-5">

    <div class="row g-5">

        <!-- BAGIAN KIRI -->
        <div class="col-md-5">

            <!-- SYARAT -->
            <div class="card bg-pastel-green border-0 p-4 text-white rounded-4 shadow mb-4">

                <h5 class="fw-bold">📝 Syarat Pendaftaran</h5>

                <ul class="mt-3 small">
                    <li>Usia minimal 4 tahun (TK A)</li>
                    <li>Fotokopi Akta Kelahiran</li>
                    <li>Fotokopi KK & KTP Orang Tua</li>
                    <li>Pas Foto 3x4 (2 lembar)</li>
                </ul>

            </div>

            <!-- BIAYA -->
            <div class="card border-0 p-4 shadow-sm rounded-4 mb-4"
                style="border-left: 5px solid #ff9a9e !important;">

                <h5 class="fw-bold">💰 Biaya Pendidikan</h5>

                <p class="small text-muted">
                    Estimasi biaya masuk:
                </p>

                <div class="d-flex justify-content-between mb-1">
                    <span>Uang Pangkal</span>
                    <b>Rp 3.000.000</b>
                </div>

                <div class="d-flex justify-content-between mb-1">
                    <span>SPP Bulanan</span>
                    <b>Rp 350.000</b>
                </div>

            </div>

            <!-- HUBUNGI KAMI -->
            <div class="card border-0 p-4 shadow-sm rounded-4"
                style="border-left: 5px solid #77dd77 !important;">

                <h5 class="fw-bold mb-3">📞 Hubungi Kami</h5>

                <p class="mb-3">
                    <strong>Alamat:</strong><br>
                    <?= htmlspecialchars($profil['alamat_sekolah'] ?? '-'); ?>
                </p>

                <p class="mb-3">
                    <strong>No. Telepon:</strong><br>
                    <?= htmlspecialchars($profil['no_telp'] ?? '-'); ?>
                </p>

                <p class="mb-0">
                    <strong>Email:</strong><br>
                    <?= htmlspecialchars($profil['email'] ?? '-'); ?>
                </p>

            </div>

        </div>

        <!-- BAGIAN KANAN -->
        <div class="col-md-7">

            <div class="card border-0 shadow p-4 rounded-4">

                <h4 class="fw-bold mb-4">
                    Formulir Pendaftaran
                </h4>

                <form method="POST" action="proses_daftar.php">

                    <div class="mb-3">

                        <label class="form-label small">
                            Nama Lengkap Anak
                        </label>

                        <input type="text"
                            name="nama_anak"
                            class="form-control"
                            placeholder="Nama lengkap anak"
                            required>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label small">
                                Jenis Kelamin
                            </label>

                            <select name="jenis_kelamin"
                                class="form-select"
                                required>

                                <option value="">-- Pilih --</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label small">
                                Tanggal Lahir
                            </label>

                            <input type="date"
                                name="tanggal_lahir"
                                class="form-control"
                                required>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label small">
                                Nama Ayah
                            </label>

                            <input type="text"
                                name="nama_ayah"
                                class="form-control"
                                placeholder="Nama ayah"
                                required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label small">
                                Nama Ibu
                            </label>

                            <input type="text"
                                name="nama_ibu"
                                class="form-control"
                                placeholder="Nama ibu"
                                required>

                        </div>

                    </div>

                    <div class="mb-3">

                        <label class="form-label small">
                            No. Telepon Orang Tua
                        </label>

                        <input type="text"
                            name="no_hp_ortu"
                            class="form-control"
                            placeholder="Contoh: 08123456789"
                            required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label small">
                            Alamat Lengkap
                        </label>

                        <textarea name="alamat"
                            class="form-control"
                            rows="3"
                            placeholder="Alamat lengkap"
                            required></textarea>

                    </div>

                    <button type="submit"
                        class="btn btn-daftar w-100 py-2 shadow-sm">

                        Kirim Pendaftaran

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

<?php include 'footer.php'; ?>