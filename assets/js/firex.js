function sukses($data) {
    if ($data == "tambah") {
        swal({
            title: 'Berhasil!',
            type: 'success',
            text: 'Sukses menambah data',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-light',
            background: '#fff url(../../global/images/backgrounds/seamless.png) repeat'
        });
    } else if ($data == "edit") {
        swal({
            title: 'Berhasil!',
            type: 'success',
            text: 'Sukses merubah data',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-light',
            background: '#fff url(../../global/images/backgrounds/seamless.png) repeat'
        });
    } else if ($data == "hapus") {
        swal({
            title: 'Berhasil!',
            type: 'success',
            text: 'Sukses menghapus data',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-light',
            background: '#fff url(../../global/images/backgrounds/seamless.png) repeat'
        });
    } else if ($data == "terima") {
        swal({
            title: 'Berhasil!',
            type: 'success',
            text: 'Sukses menerima permohonan',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-light',
            background: '#fff url(../../global/images/backgrounds/seamless.png) repeat'
        });
    } else if ($data == "tolak") {
        swal({
            title: 'Berhasil!',
            type: 'success',
            text: 'Sukses menolak permohonan',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-light',
            background: '#fff url(../../global/images/backgrounds/seamless.png) repeat'
        });
    }else if ($data == "proses") {
        swal({
            title: 'Berhasil!',
            type: 'success',
            text: 'Sukses memproses data',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-light',
            background: '#fff url(../../global/images/backgrounds/seamless.png) repeat'
        });
    }else if ($data == "login") {
        swal({
            title: 'Login Berhasil!',
            type: 'success',
            text: 'Mohon tunggu...',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-light',
            background: '#fff url(../../global/images/backgrounds/seamless.png) repeat'
        });
    } 

}

function gagal($data) {
    if ($data == "tambah") {
        swal({
            title: 'Gagal!',
            type: 'error',
            cancelButtonClass: 'btn btn-light',
            confirmButtonClass: 'btn btn-danger',
            text: 'Gagal menambah data',
            background: '#fff url(../../global/images/backgrounds/seamless.png) repeat'
        });
    } else if ($data == "edit") {
        swal({
            title: 'Gagal!',
            type: 'error',
            cancelButtonClass: 'btn btn-light',
            confirmButtonClass: 'btn btn-danger',
            text: 'Gagal merubah data',
            background: '#fff url(../../global/images/backgrounds/seamless.png) repeat'
        });
    } else if ($data == "hapus") {
        swal({
            title: 'Gagal!',
            type: 'error',
            cancelButtonClass: 'btn btn-light',
            confirmButtonClass: 'btn btn-danger',
            text: 'Gagal menghapus data',
            background: '#fff url(../../global/images/backgrounds/seamless.png) repeat'
        });
    } else if ($data == "terima") {
        swal({
            title: 'Gagal!',
            type: 'error',
            cancelButtonClass: 'btn btn-light',
            confirmButtonClass: 'btn btn-danger',
            text: 'Gagal menerima permohonan',
            background: '#fff url(../../global/images/backgrounds/seamless.png) repeat'
        });
    } else if ($data == "tolak") {
        swal({
            title: 'Gagal!',
            type: 'error',
            cancelButtonClass: 'btn btn-light',
            confirmButtonClass: 'btn btn-danger',
            text: 'Gagal menolak permohonan',
            background: '#fff url(../../global/images/backgrounds/seamless.png) repeat'
        });
    }else if ($data == "proses") {
        swal({
            title: 'Gagal!',
            type: 'error',
            cancelButtonClass: 'btn btn-light',
            confirmButtonClass: 'btn btn-danger',
            text: 'Gagal memproses data',
            background: '#fff url(../../global/images/backgrounds/seamless.png) repeat'
        });
    }else if ($data == "login") {
        swal({
            title: 'Login Gagal!',
            type: 'error',
            cancelButtonClass: 'btn btn-light',
            confirmButtonClass: 'btn btn-danger',
            text: 'Kombinasi Username dan Password tidak cocok',
            background: '#fff url(../../global/images/backgrounds/seamless.png) repeat'
        });
    } 
}
