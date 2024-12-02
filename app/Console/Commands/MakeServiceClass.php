<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeServiceClass extends Command
{
    protected $signature = 'make:service {name} {--module=} {--is_app_service=}';

    protected $description = 'Create a service class';

    public function handle(): void
    {
        $name = $this->argument('name');

        $module = $this->option('module');

        $is_app_service = $this->option('is_app_service') === 'true';

        $defaultPath = $is_app_service
            ? 'app/Application/Services/{module}/{name}Service.php'
            : 'app/Domain/Services/{module}/{name}Service.php';

        $path = str_replace('{name}', $name, $defaultPath);
        $path = str_replace('{module}', $module, $path);

        File::put($path, $this->getServiceClassStub($module, $name, $is_app_service));

        $this->info("{$name}Service class created successfully.");
    }

    //...getServiceClassStub method
    protected function getServiceClassStub(string $module, string $name, bool $is_app_service): string
    {

        $name_space = $is_app_service
            ? 'namespace App\\Application\\Services\\' . $module . ';'
            : 'namespace App\\Domain\\Services\\' . $module . ';';

        return <<<CONTENT
        <?php

        $name_space

        use App\\Application\\UseCases\\$module\\{$name}\\Get{$name}DetailsUseCase;
        use App\\Application\\UseCases\\$module\\{$name}\\Create{$name}UseCase;
        use App\\Application\\UseCases\\$module\\{$name}\\Delete{$name}UseCase;
        use App\\Application\\UseCases\\$module\\{$name}\\Update{$name}UseCase;

        class {$name}Service
        {
            public function get{$name}Details(\$id)
            {
                return app(Get{$name}DetailsUseCase::class)->execute(\$id);
            }

            public function save{$name}(\$data)
            {
                return app(Create{$name}UseCase::class)->execute(\$data);
            }

            public function update{$name}(\$data)
            {
                return app(Update{$name}UseCase::class)->execute(\$data);
            }

            public function delete{$name}(\$data): void
            {
                app(Delete{$name}UseCase::class)->execute(\$data);
            }
        }

        CONTENT;
    }

}
