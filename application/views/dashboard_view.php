<h2 class="text-lg font-bold text-gray-700 mb-4">Jadwal Kuliah</h2>

<?php if(empty($jadwal)): ?>
    <div class="flex flex-col items-center justify-center py-10 opacity-70">
        <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mb-4 text-4xl">
            💤
        </div>
        <p class="text-gray-500 font-medium">Tidak ada kelas hari ini.</p>
        <p class="text-gray-400 text-sm">Selamat beristirahat!</p>
    </div>
<?php else: ?>
    <div class="space-y-4">
        <?php foreach($jadwal as $row): ?>
        <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex items-center relative overflow-hidden group">
            
            <div class="absolute left-0 top-0 bottom-0 w-1.5" style="background-color: <?= $row->warna; ?>;"></div>

            <div class="flex-1 pl-3">
                <div class="flex justify-between items-start mb-1">
                    <span class="bg-gray-100 text-gray-600 text-xs font-bold px-2 py-1 rounded-md">
                        ⏰ <?= substr($row->jam_mulai, 0, 5) . ' - ' . substr($row->jam_selesai, 0, 5); ?>
                    </span>
                    <span class="text-xs font-medium text-gray-400 flex items-center">
                        📍 R. <?= $row->kode_ruang; ?>
                    </span>
                </div>
                
                <h3 class="text-gray-800 font-bold text-lg leading-tight mb-1">
                    <?= $row->nama_matkul; ?>
                </h3>
                
                <p class="text-sm text-gray-500 flex items-center">
                    👨‍🏫 <?= $row->kode_dosen; ?>
                </p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>