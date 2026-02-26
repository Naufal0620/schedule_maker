<div class="space-y-6">
    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
        <div class="flex items-center mb-4">
            <div class="bg-green-100 p-2 rounded-lg text-green-600 mr-3">🔍</div>
            <h3 class="font-bold text-gray-800 text-lg">Cari Ruangan Kosong</h3>
        </div>
        
        <form method="GET" action="<?= site_url('ruangan'); ?>">
            <div class="grid grid-cols-1 gap-3 mb-4">
                <div>
                    <label class="text-xs font-semibold text-gray-500 mb-1 block">Hari</label>
                    <select name="hari" class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-blue-500 bg-gray-50" required>
                        <option value="">Pilih Hari...</option>
                        <option value="SENIN">Senin</option><option value="SELASA">Selasa</option>
                        <option value="RABU">Rabu</option><option value="KAMIS">Kamis</option>
                        <option value="JUMAT">Jumat</option><option value="SABTU">Sabtu</option>
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-xs font-semibold text-gray-500 mb-1 block">Dari Jam</label>
                        <select name="jam_mulai" class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-blue-500 bg-gray-50" required>
                            <option value="">Mulai...</option>
                            <?php foreach($list_waktu as $w): ?>
                                <option value="<?= $w->id; ?>"><?= substr($w->jam_mulai, 0, 5); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="text-xs font-semibold text-gray-500 mb-1 block">Sampai Jam</label>
                        <select name="jam_selesai" class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-blue-500 bg-gray-50" required>
                            <option value="">Selesai...</option>
                            <?php foreach($list_waktu as $w): ?>
                                <option value="<?= $w->id; ?>"><?= substr($w->jam_selesai, 0, 5); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" name="cari_kosong" value="1" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 rounded-xl text-sm transition shadow-md">
                Cari Ruangan
            </button>
        </form>
    </div>

    <?php if(isset($ruangan_kosong)): ?>
        <div class="bg-green-50 p-4 rounded-xl border border-green-100">
            <p class="text-xs text-green-700 mb-2 font-medium">
                Ketersediaan pada <?= $info_cari_kosong['hari']; ?>, <?= substr($info_cari_kosong['mulai'], 0, 5); ?> - <?= substr($info_cari_kosong['selesai'], 0, 5); ?>:
            </p>
            <?php if(empty($ruangan_kosong)): ?>
                <p class="text-sm font-bold text-red-500">Waduh, semua ruangan penuh! 😔</p>
            <?php else: ?>
                <div class="flex flex-wrap gap-2">
                    <?php foreach($ruangan_kosong as $rk): ?>
                        <span class="bg-white text-green-700 border border-green-200 text-sm font-bold px-3 py-1.5 rounded-lg shadow-sm">
                            <?= $rk->kode; ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <hr class="border-gray-200">

    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
        <div class="flex items-center mb-4">
            <div class="bg-blue-100 p-2 rounded-lg text-blue-600 mr-3">📍</div>
            <h3 class="font-bold text-gray-800 text-lg">Lihat Jadwal Ruangan</h3>
        </div>
        
        <form method="GET" action="<?= site_url('ruangan'); ?>">
            <div class="mb-4">
                <label class="text-xs font-semibold text-gray-500 mb-1 block">Pilih Ruangan</label>
                <select name="id_ruangan" class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-blue-500 bg-gray-50" required>
                    <option value="">Pilih...</option>
                    <?php foreach($list_ruangan as $r): ?>
                        <option value="<?= $r->id; ?>"><?= $r->kode; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" name="cari_jadwal" value="1" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 rounded-xl text-sm transition shadow-md">
                Lihat Jadwal
            </button>
        </form>
    </div>

    <?php if(isset($jadwal_ruang)): ?>
        <div class="mt-4">
            <h4 class="font-bold text-gray-800 mb-3 text-center bg-gray-100 py-2 rounded-lg">
                Jadwal R. <?= $ruangan_terpilih->kode; ?>
            </h4>
            
            <?php if(empty($jadwal_ruang)): ?>
                <p class="text-center text-sm text-gray-500 py-4">Belum ada jadwal di ruangan ini.</p>
            <?php else: ?>
                <?php foreach($jadwal_ruang as $hari => $list_matkul): ?>
                    <div class="mb-3 mt-4 first:mt-0">
                        <h2 class="text-sm font-black text-gray-600 uppercase tracking-wide border-l-4 border-blue-500 pl-2">
                            <?= $hari; ?>
                        </h2>
                    </div>
                    <div class="space-y-2 mb-4">
                        <?php foreach($list_matkul as $row): ?>
                        <div class="bg-white p-3 rounded-xl shadow-sm border border-gray-100 flex relative overflow-hidden">
                            <div class="absolute left-0 top-0 bottom-0 w-1" style="background-color: <?= $row->warna; ?>;"></div>
                            <div class="pl-2 w-full">
                                <div class="flex justify-between items-start">
                                    <h3 class="text-gray-800 font-bold text-sm leading-tight max-w-[70%]">
                                        <?= $row->nama_matkul; ?> <span class="text-xs text-blue-500">(<?= $row->nama_kelas; ?>)</span>
                                    </h3>
                                    <span class="text-[10px] bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 font-bold">
                                        <?= substr($row->jam_mulai, 0, 5); ?> - <?= substr($row->jam_selesai, 0, 5); ?>
                                    </span>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">👨‍🏫 <?= $row->kode_dosen; ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    
    <div class="h-6"></div>
</div>