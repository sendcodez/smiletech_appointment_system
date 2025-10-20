<?php


use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\DentistController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AcitivtyLogController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PatientsAppointmentController;
use App\Http\Controllers\ManageAppointmentController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\ResultsController;
use App\Http\Controllers\PatientProfileController;
use App\Http\Controllers\CustomerSupportController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\FaqController;
use App\Models\User;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!

*/
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/about', [IndexController::class, 'about'])->name('about');
Route::get('/services', [IndexController::class, 'services'])->name('services');
Route::get('/dentist', [IndexController::class, 'dentist'])->name('dentist');

Route::get('login', [IndexController::class, 'login'])->name('login');

//AUTH
Route::post('/password/hash', 'PasswordController@hash')->name('password.hash');
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified', 'check.status'])
    ->name('admin.dashboard');



Route::middleware('auth')->group(function () {

    //DASHBOARD ROUTE
    Route::get('/chart-data', [DashboardController::class, 'chartData'])->name('chart.data');


    //DENTIST ROUTE
    Route::get('admin/dentist', [DentistController::class, 'index'])->name('dentist.index');
    Route::post('admin/add_dentists', [DentistController::class, 'store'])->name('dentist.store');
    Route::patch('/update-dentist-status/{id}', [DentistController::class, 'updateStatus'])->name('update-dentist-status');
    Route::put('admin/update_dentist{dentist}', [DentistController::class, 'update'])->name('dentist.update');
    Route::delete('/dentist/{id}', [DentistController::class, 'destroy'])->name('dentist.destroy');

    //SERVICES ROUTE
    Route::get('admin/service', [ServiceController::class, 'index'])->name('service.index');
    Route::post('admin/add_services', [ServiceController::class, 'store'])->name('service.store');
    Route::patch('/update-service-status/{id}', [ServiceController::class, 'updateStatus'])->name('update-service-status');
    Route::delete('/service/{id}', [ServiceController::class, 'destroy'])->name('service.destroy');
    Route::put('/service/{id}', [ServiceController::class, 'update'])->name('service.update');

    //USERS ROUTE
    Route::get('admin/users', [UserController::class, 'index'])->name('user.index');
    Route::post('admin/add_users', [UserController::class, 'store'])->name('user.store');
    Route::patch('/update-user-status/{id}', [UserController::class, 'updateStatus'])->name('update-user-status');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    //ACTIVITY LOG ROUTE
    Route::get('admin/activity', [AcitivtyLogController::class, 'index'])->name('activity.show');



    //WEBSITE ROUTE
    Route::get('admin/website', [WebsiteController::class, 'index'])->name('website.index');
    Route::post('admin/website/update', [WebsiteController::class, 'update'])->name('website.update');


    //APPOINTMENT ROUTE
    Route::get('/appointment', [AppointmentController::class, 'index'])->name('appointment.index');
    Route::post('appointmetn/add_appointment', [AppointmentController::class, 'store'])->name('appointment.store');
    Route::get('/get-appointments', [AppointmentController::class, 'getAppointments'])->name('get-appointments');
    Route::put('/appointments/{id}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');
    Route::put('/appointments/{id}/approve', [ManageAppointmentController::class, 'approve'])->name('appointments.approve');
    Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
    Route::put('/appointments/{id}/complete', [AppointmentController::class, 'complete'])->name('appointments.complete');
    Route::put('/appointments/reschedule', [AppointmentController::class, 'reschedule'])->name('appointments.reschedule');


    //MYPATIENTS APPOINTMENT
    Route::get('dentist/appointment', [PatientsAppointmentController::class, 'index'])->name('dentist_app.index');

    //MANAGE APPOINTMENT ROUTE
    Route::get('admin/appointments', [ManageAppointmentController::class, 'index'])->name('manage_app.index');

    //RESULTS ROUTE
    Route::post('/results', [ResultsController::class, 'store'])->name('results.store');

    //RECORDS ROUTE
    Route::get('patient/records', [ResultsController::class, 'index'])->name('results.index');


    //PATIENTS ROUTE
    Route::get('admin/patients', [PatientProfileController::class, 'index'])->name('patients.index');
    Route::post('admin/save_patients', [PatientProfileController::class, 'store'])->name('patients.store');
    Route::delete('/patient/{id}', [PatientProfileController::class, 'destroy'])->name('patients.destroy');
    Route::put('admin/patients{id}', [PatientProfileController::class, 'update'])->name('patients.update');

    //CUSTOMER SUPPORT ROUTE
    Route::get('admin/customer-support', [CustomerSupportController::class, 'index'])->name('support.index');

    //FAQ ROUTE
    Route::get('admin/faq', [FaqController::class, 'faq'])->name('faq.index');
    Route::get('patient/faq', [FaqController::class, 'faq_patient'])->name('faq.patient');
    Route::get('admin/faq-categories', [FaqController::class, 'faq_category'])->name('faq.categories');
    Route::post('admin/add-faq-categories', [FaqController::class, 'faq_category_store'])->name('faq_categories.store');
    Route::post('admin/add-faqs', [FaqController::class, 'faq_store'])->name('faq.store');
    Route::patch('/update-faq-status/{id}', [FaqController::class, 'updateStatus'])->name('update-faq-status');
    Route::delete('/faq/{id}', [FaqController::class, 'destroy'])->name('faq.destroy');

    //REPORTS ROUTE
    Route::get('admin/reports', [ReportsController::class, 'index'])->name('reports.index');
    Route::post('/reports/filter', [ReportsController::class, 'filter'])->name('reports.filter');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/appointments/completed', [AppointmentController::class, 'getCompleted'])->name('appointments.completed');
    Route::get('/appointments/all', [AppointmentController::class, 'getAllAppointments'])->name('appointments.all');
    Route::get('/patients/all', [PatientProfileController::class, 'getAllPatients'])->name('patients.all');
    Route::get('/users/all', [UserController::class, 'getUser'])->name('users.all');
});

require __DIR__ . '/auth.php';
