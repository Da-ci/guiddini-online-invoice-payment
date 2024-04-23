import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/Admin/**/*.php',
        './resources/views/filament/admin/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './resources/views/filament/resources/admin/pages/create-admin.blade.php',
        './resources/views/components/users/is-not-active.blade.php',
        './resources/views/components/**/*.php',
    ],
}
