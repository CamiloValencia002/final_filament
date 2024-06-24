<?php
use Filament\Forms;
use Filament\Forms\Form;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use App\Models\Driver;
use Filament\Http\Responses\Auth\Contracts\RegistrationResponse;
use Filament\Notifications\Notification;


class Register extends \Filament\Pages\Auth\Register
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('last_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(Driver::class),
                Forms\Components\TextInput::make('telephone')
                    ->tel()
                    ->required(),
                Forms\Components\TextInput::make('adress')
                    ->required(),
                Forms\Components\TextInput::make('document')
                    ->required()
                    ->unique(Driver::class),
                Forms\Components\TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required()
                    ->minLength(8)
                    ->same('passwordConfirmation'),
                Forms\Components\TextInput::make('passwordConfirmation')
                    ->label('Password Confirmation')
                    ->password()
                    ->required()
                    ->minLength(8),
            ]);
    }

    public function register(): ?RegistrationResponse
    {
        try {
            $data = $this->form->getState();
       
            $data['id_admin'] = 1; // Asigna id_admin como 1
            $data['document_verify'] = false; // Por defecto, no verificado
            $data['role'] = 'driver'; // Asigna el rol de conductor
            $data['ratings'] = 0; // Inicializa las calificaciones en 0
       
            $driver = Driver::create([
                ...$data,
                'password' => Hash::make($data['password']),
            ]);

            event(new Registered($driver));



            Notification::make()
            ->title('Registro exitoso')
            ->body('Por favor, inicia sesión con tus nuevas credenciales.')
            ->success()
            ->send();

            //Falta añadir la ruta para redireccionar al login y poder que inicie sesión

 
        } catch (\Exception $e) {
            Notification::make()
                ->title('Error en el registro')
                ->body($e->getMessage())
                ->danger()
                ->send();

            return null;
        }
    }

}