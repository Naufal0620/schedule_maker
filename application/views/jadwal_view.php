<?php if(empty($grouped_jadwal)): ?>
    <div class="text-center py-12 text-gray-400 flex flex-col items-center justify-center">
        <i class="fa-regular fa-calendar-xmark text-5xl mb-4 text-gray-300"></i>
        <p>Belum ada jadwal kuliah.</p>
    </div>
<?php else: ?>

    <?php foreach($grouped_jadwal as $hari => $list_matkul): ?>
        
        <div class="mb-3 mt-6 first:mt-0">
            <h2 class="text-lg font-black text-gray-800 uppercase tracking-wide border-l-4 border-blue-500 pl-3">
                <?= $hari; ?>
            </h2>
        </div>

        <div class="space-y-3 mb-6">
            <?php foreach($list_matkul as $row): ?>
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex relative overflow-hidden">
                
                <div class="absolute left-0 top-0 bottom-0 w-1" style="background-color: <?= $row->warna; ?>;"></div>

                <div class="pl-3 w-full">
                    <div class="flex justify-between items-start">
                        <h3 class="text-gray-800 font-bold text-base leading-tight">
                            <?= $row->nama_matkul; ?>
                        </h3>
                        <span class="text-[10px] bg-gray-100 px-2 py-0.5 rounded text-gray-600 font-bold flex items-center whitespace-nowrap ml-2">
                            <i class="fa-regular fa-clock mr-1 text-gray-400"></i> <?= substr($row->jam_mulai, 0, 5); ?>
                        </span>
                    </div>
                    
                    <div class="flex justify-between items-center mt-2">
                        <p class="text-xs text-gray-500 flex items-center">
                            <i class="fa-solid fa-chalkboard-user mr-1.5 text-gray-400"></i> <?= $row->kode_dosen; ?>
                        </p>
                        <p class="text-xs text-gray-500 font-medium flex items-center">
                            <i class="fa-solid fa-location-dot mr-1 text-blue-400"></i> <?= $row->kode_ruang; ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    <?php endforeach; ?>

    <div class="h-10"></div>

<?php endif; ?>