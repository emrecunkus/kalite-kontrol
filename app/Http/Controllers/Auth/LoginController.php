<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use LdapRecord\Container;
use App\Observers\LoginObserver;

class LoginController extends Controller
{
    protected $loginObserver;

    public function __construct()
    {
        $this->loginObserver = new LoginObserver();
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $samAccountName = 'ASPILSAN\\' . $credentials['username'];
        $request->session()->put('username', $credentials['username']);

        try {
            $ldapConnection = Container::getConnection();
            $ldapConnection->connect();

            if ($ldapConnection->auth()->attempt($samAccountName, $credentials['password'])) {
                // Whitelist kontrolü
                $whitelist = [
                    'feyzionur.baran' => 'tekniker',
                    'cagatay.cakir' => 'mühendis',
                    'muhammedemre.cunkus' => 'tekniker',
                    'cagatay.cakir' => 'mühendis',
                    'stajyer.bt' =>'mühendis',
                    
                ];

                if (!array_key_exists($credentials['username'], $whitelist)) {
                    return back()->withErrors([
                        'username' => 'Unauthorized user.',
                    ]);
                }

                // Kullanıcının rolü session'a kaydediliyor
                $role = $whitelist[$credentials['username']];
                $request->session()->put('role', $role);
                $request->session()->put('name', $credentials['username']); // Kullanıcı adını kaydediyoruz
                Log::info('Role session\'a kaydedildi', ['role' => $role]);

                // Session verilerini logla
                Log::info('Session verileri', ['session' => $request->session()->all()]);

                // Rol bazlı yönlendirme
                if ($role === 'tekniker') {
                    return redirect()->route('tekniker.form');
                } elseif ($role === 'mühendis') {
                    return redirect()->route('mühendis.assigned');
                }
            } else {
                return back()->withErrors([
                    'username' => 'Şifre ya da kullanıcı adınız yanlış',
                ]);
            }
        } catch (\Exception $e) {
            return back()->withErrors([
                'username' => 'LDAP connection failed: ' . $e->getMessage(),
            ]);
        }
    }

    public function logout(Request $request)
    {
        // Kullanıcı adını session'dan alıyoruz
        $samAccountName = $request->session()->get('username');

        if ($samAccountName) {
            $this->loginObserver->userLoggedOut($samAccountName);
            Log::info('Logout işlemi başarılı. Kullanıcı: ' . $samAccountName);
        } else {
            Log::warning('Username not found in session during logout');
        }

        // Oturumu kapatıyoruz
        Auth::logout();
        Log::info('Kullanıcı oturumu kapattı');

        // Session'ı temizliyoruz
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Log::info('Session temizlendi.');

        // Kullanıcıyı login sayfasına yönlendiriyoruz
        return redirect('/login');
    }
}
