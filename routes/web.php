<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log; // Log sınıfını ekleyelim
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\QualityFormController;

// Root rotası, ana sayfaya gidildiğinde login sayfasına yönlendirir
Route::get('/', function () {
    return redirect()->route('login');
});

// Login rotası
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard rotası
Route::get('/dashboard', function () {
    // Sadece basit bir dashboard sayfası render ediliyor, oturum kontrolü yok
    Log::info('Dashboard görüntüleniyor.');
    return view('dashboard');
})->name('dashboard');

// Tekniker için form oluşturma ve kaydetme rotaları
Route::get('/form', [QualityFormController::class, 'create'])->name('tekniker.form');
Route::post('/form', [QualityFormController::class, 'store'])->name('quality_forms.store');

// Mühendis için atanmış Formlar sayfası
Route::get('/assigned', [QualityFormController::class, 'showAssignedForms'])->name('mühendis.assigned');
Route::get('/report', [QualityFormController::class, 'showReport'])->name('mühendis.report');
Route::get('/tum_report', [QualityFormController::class, 'showTumReport'])->name('mühendis.tum_report');



// Mühendis Formları onaylama ve reddetme işlemleri
Route::post('/approve/{id}', [QualityFormController::class, 'approve'])->name('form.approve');
Route::post('/reject/{id}', [QualityFormController::class, 'reject'])->name('form.reject');

// Formu düzenleme sayfası için rota
Route::get('/forms/{id}/edit', [QualityFormController::class, 'edit'])->name('form.edit');

//readonly görmek için rota;
Route::get('/forms/{id}/showReadOnly', [QualityFormController::class, 'showReadOnly'])->name('form.showReadOnly');

// Formu güncelleme işlemi için rota
Route::put('/forms/{id}', [QualityFormController::class, 'update'])->name('form.update');

// Teknikerin onaya gönderdiği Formlarin durumu
Route::get('/technician/submitted-forms', [QualityFormController::class, 'submittedForms'])->name('technician.submitted.forms');

Route::get('/rejected-forms', [QualityFormController::class, 'rejectedForms'])->name('rejected.forms');


Route::get('/profile', function () {
    $username = auth()->user()->username ?? 'Misafir';  // Kullanıcı adı
    $ip = request()->ip();  // Kullanıcının IP adresi
    $role = session()->get('role', 'Yetkisiz');  // Kullanıcının yetkisi
    
    return view('profile', compact('username', 'ip', 'role'));
})->name('profile');

Route::delete('/form/delete/{id}', [QualityFormController::class, 'delete'])->name('form.delete');
Route::get('/technician/rejected-forms', [QualityFormController::class, 'rejectedForms'])->name('technician.rejected_forms');


