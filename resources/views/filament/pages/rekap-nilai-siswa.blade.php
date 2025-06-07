<x-filament::page>
    <x-filament::card>
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">Kelas</th>
                    <th class="px-4 py-2">Nama Siswa</th>
                    <th class="px-4 py-2">Nilai Tugas</th>
                    <th class="px-4 py-2">Nilai UTS</th>
                    <th class="px-4 py-2">Nilai UAS</th>
                    <th class="px-4 py-2">Nilai Akhir</th>
                    <th class="px-4 py-2">Grade</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($this->data as $item)
                    <tr>
                        <td class="border px-4 py-2">{{ $item['kelas'] }}</td>
                        <td class="border px-4 py-2">{{ $item['nama_siswa'] }}</td>
                        <td class="border px-4 py-2">{{ $item['nilai_tugas'] }}</td>
                        <td class="border px-4 py-2">{{ $item['nilai_uts'] }}</td>
                        <td class="border px-4 py-2">{{ $item['nilai_uas'] }}</td>
                        <td class="border px-4 py-2">{{ $item['nilai_akhir'] }}</td>
                        <td class="border px-4 py-2">{{ $item['grade'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-filament::card>
</x-filament::page>
