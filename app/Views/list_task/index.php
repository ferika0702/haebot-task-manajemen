<?= $this->extend('MyLayout/template') ?>

<?= $this->section('content') ?>

<main class="p-md-3 p-2">

    <div class="d-flex mt-1">
        <div class="me-auto mb-1">
            <h3 style="color: #566573;">Task Manajemen</h3>
        </div>
        <div class="mb-1">
            <a class="btn btn-sm btn-outline-secondary mb-3" id="tombolTambah">
                <i class="fa-fw fa-solid fa-plus"></i> Tambah Task
            </a>
        </div>
    </div>

    <hr class="mt-0 mb-4">

    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    </thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Frequency</th>
                                            <th class="text-center">Start</th>
                                            <th class="text-center">End</th>
                                            <th class="text-center">Absen</th>
                                            <th class="text-center">status</th>
                                            <th class="text-center">aksi</th>
                                        </tr>
                                    <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach ($task as $t) : ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td class="text-center"><?= $t['nama'] ?></td>
                                                <td class="text-center"><?= $t['list_frequency'] ?></td>
                                                <td class="text-center"><?= $t['start_time'] ?></td>
                                                <td class="text-center"><?= $t['end_time'] ?></td>
                                                <td class="text-center"><?= $t['list_absen'] ?></td>
                                                <td ><?= $t['status'] ?></td>
                                                <td class="text-center">
                                                <a title="Edit" class="px-2 py-0 btn btn-sm btn-outline-primary" onclick="showModalEdit(<?= $t['id'] ?>)">
                                                    <i class="fa-fw fa-solid fa-pen"></i>
                                                </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
</main>

<?= $this->include('MyLayout/js') ?>

<!-- Modal -->
<div class="modal fade" id="my-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="judulModal"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="isiForm">

            </div>
        </div>
    </div>
</div>
<!-- Modal -->

<script>
    // Bahan Alert
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        background: '#EC7063',
        color: '#fff',
        iconColor: '#fff',
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    $(document).ready(function() {
        $('#dataTable').DataTable();

        // Alert
        var op = <?= (!empty(session()->getFlashdata('pesan')) ? json_encode(session()->getFlashdata('pesan')) : '""'); ?>;
        if (op != '') {
            Toast.fire({
                icon: 'success',
                title: op
            })
        }
    });

    $('#tombolTambah').click(function(e) {
        e.preventDefault();
        showModalTambah();
    })

    function showModalTambah() {
        $.ajax({
            type: 'GET',
            url: '<?= site_url() ?>task/new',
            dataType: 'json',
            success: function(res) {
                if (res.data) {
                    $('#isiForm').html(res.data)
                    $('#my-modal').modal('toggle')
                    $('#judulModal').html('Tambah Task')
                }
            },
            error: function(e) {
                alert('Error \n' + e.responseText);
            }
        })
    }

    function showModalEdit(id) {
        $.ajax({
            type: 'GET',
            url: '<?= site_url() ?>task/' + id + '/edit',
            dataType: 'json',
            success: function(res) {
                if (res.data) {
                    $('#isiForm').html(res.data)
                    $('#my-modal').modal('toggle')
                    $('#judulModal').html('Edit Task')
                    console.log(res.data)
                } else {
                    console.log("error")
                }
            },
            error: function(e) {
                alert('Error \n' + e.responseText);
            }
        })
    }


</script>

<?= $this->endSection() ?>