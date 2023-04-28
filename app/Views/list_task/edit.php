<form autocomplete="off" class="row g-3 mt-2" action="<?= site_url() ?>task/<?= $task['id'] ?>" method="POST" id="form-edit">

    <?= csrf_field() ?>

    <input type="hidden" name="_method" value="PUT">

    <div class="row mb-3">
        <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $task['nama']; ?>">
            <div class="invalid-feedback error-nama"></div>
        </div>
    </div>

    <div class="row mb-3">
        <label for="start_time" class="col-sm-3 col-form-label">Start Time</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="start_time" name="start_time" value="<?= $task['start_time']; ?>">
            <div class="invalid-feedback error-start_time"></div>
        </div>
    </div>

    <div class="row mb-3">
        <label for="end_time" class="col-sm-3 col-form-label">End Time</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="end_time" name="end_time" value="<?= $task['end_time']; ?>">
            <div class="invalid-feedback error-end_time"></div>
        </div>
    </div>

    <div class="row mb-3">
        <label for="status" class="col-sm-3 col-form-label">Status</label>
        <div class="col-sm-9">
            <select class="form-control" name="status" id="status" >
                <option value="<?= $task['status']; ?>"><?= $task['status']; ?></option>
                <option value="ON">On</option>
                <option value="OFF">Off</option>
            </select>
            <div class="invalid-feedback error-status"></div>
        </div>
    </div>

    <div class="row mb-3">
        <label for="list_frequency" class="col-sm-3 col-form-label">List Frequency</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="list_frequency" name="list_frequency" value="<?= $task['list_frequency']; ?>">
            <div class="invalid-feedback error-list_frequency"></div>
        </div>
    </div>

    <div class="row mb-3">
        <label for="list_absen" class="col-sm-3 col-form-label">List Absen</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="list_absen" name="list_absen" value="<?= $task['list_absen']; ?>">
            <div class="invalid-feedback error-list_absen"></div>
        </div>
    </div>

    <div class="col-md-9 offset-3 mb-3">
        <button id="#tombolUpdate" class="btn px-5 btn-outline-primary" type="submit">Update<i class="fa-fw fa-solid fa-check"></i></button>
    </div>
</form>

<?= $this->include('MyLayout/js') ?>


<script>
    $('#form-edit').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('#tombolSimpan').html('Tunggu <i class="fa-solid fa-spin fa-spinner"></i>');
                $('#tombolSimpan').prop('disabled', true);
            },
            complete: function() {
                $('#tombolSimpan').html('Simpan <i class="fa-fw fa-solid fa-check"></i>');
                $('#tombolSimpan').prop('disabled', false);
            },
            success: function(response) {
                if (response.error) {
                    let err = response.error;

                    if (err.error_nama) {
                        $('.error-nama').html(err.error_nama);
                        $('#nama').addClass('is-invalid');
                    } else {
                        $('.error-nama').html('');
                        $('#nama').removeClass('is-invalid');
                        $('#nama').addClass('is-valid');
                    }
                }
                if (response.success) {
                    $('#my-modal').modal('hide')
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.success,
                    }).then((value) => {
                        location.reload();
                    })
                }
            },
            error: function(e) {
                alert('Error \n' + e.responseText);
            }
        });
        return false
    })
    $(document).ready(function() {
        $("#status").select2({
            theme: "bootstrap-5",
            tags: true,
            dropdownParent: $('#my-modal')
        });
})
$(document).ready(function() {
        $('#start_time').datepicker({
            format: "yyyy-mm-dd"
        });
    })
    $(document).ready(function() {
        $('#end_time').datepicker({
            format: "yyyy-mm-dd"
        });
    })

</script>