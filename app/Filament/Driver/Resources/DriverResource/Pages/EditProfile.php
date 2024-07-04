<?php
namespace App\Filament\Driver\Resources\DriverResource\Pages;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;
use Illuminate\Support\Facades\Storage;

class EditProfile extends BaseEditProfile
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Información Personal')
                    ->schema([
                        $this->getNameFormComponent()
                            ->label('Nombre')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('last_name')
                            ->label('Apellido')
                            ->required()
                            ->maxLength(255),
                        $this->getEmailFormComponent()
                            ->label('Correo Electrónico'),
                        TextInput::make('telephone')
                            ->label('Teléfono')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        TextInput::make('adress')
                            ->label('Dirección')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Documentación')
                    ->schema([
                        TextInput::make('document')
                            ->label('Número de Documento')
                            ->required()
                            ->maxLength(255),
                        Toggle::make('document_verify')
                            ->label('Documento Verificado')
                            ->required()
                            ->disabled(),
                        FileUpload::make('photo_licence')
                            ->label('Foto de Licencia')
                            ->image()
                            ->directory('licencias'),
                    ])
                    ->columns(2),

                Section::make('Foto de Perfil')
                    ->schema([
                        FileUpload::make('image')
                        ->label('Foto de Perfil')
                        ->image()
                        ->directory('profile-photos')
                        ->imageEditor()
                        ->circleCropper()
                        ->imageCropAspectRatio('1:1')
                        ->imageResizeTargetWidth('300')
                        ->imageResizeTargetHeight('300'),
                    ]),

                Section::make('Cambiar Contraseña')
                    ->schema([
                        $this->getPasswordFormComponent()
                            ->label('Nueva Contraseña'),
                        $this->getPasswordConfirmationFormComponent()
                            ->label('Confirmar Nueva Contraseña'),
                    ])
                    ->columns(2),
            ]);
    }

}