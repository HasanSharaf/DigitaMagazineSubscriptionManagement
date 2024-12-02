<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateUseCase extends Command
{
    protected $signature = 'make:usecase {name} {--module=}';

    protected $description = 'Create use case class files';

    public function handle(): void
    {
        $name = $this->argument('name');

        $module = $this->option('module');

        $path = app_path("Application/UseCases/$module/$name");

        File::makeDirectory($path, 0755, true);

        $files = [
            [
                'path' => $path . "/Base{$name}UseCase.php",
                'content' => $this->getBaseUseCaseStub($name, $module),
            ],
            [
                'path' => $path . "/Get{$name}DetailsUseCase.php",
                'content' => $this->getGetDetailsUseCaseStub($name, $module),
            ],
            [
                'path' => $path . "/Create{$name}UseCase.php",
                'content' => $this->getCreateUseCaseStub($name, $module),
            ],
            [
                'path' => $path . "/Update{$name}UseCase.php",
                'content' => $this->getUpdateUseCaseStub($name, $module),
            ],
            [
                'path' => $path . "/Delete{$name}UseCase.php",
                'content' => $this->getDeleteUseCaseStub($name, $module),
            ],
        ];

        foreach ($files as $file) {
            File::put($file['path'], $file['content']);
        }

        $this->info("{$name} folder and class files created successfully!");
    }

    // ...stub methods here
    protected function getBaseUseCaseStub(string $name, string $module): string
    {
        $varName = lcfirst($name);

        return <<<CONTENT
        <?php

        namespace App\\Application\\UseCases\\$module\\{$name};

        use App\\Infrastructure\\Repositories\\$module\\{$name}Repository;

        abstract class Base{$name}UseCase
        {
            protected {$name}Repository \${$varName}Repository;

            public function __construct({$name}Repository \${$varName}Repository)
            {
                \$this->{$varName}Repository = \${$varName}Repository;
            }

            abstract public function execute(\$data);
        }
        CONTENT;
    }

    protected function getGetDetailsUseCaseStub(string $name, string $module): string
    {
        $varName = lcfirst($name);

        return <<<CONTENT
        <?php

        namespace App\\Application\\UseCases\\$module\\{$name};

        use Illuminate\\Database\\Eloquent\\Builder;
        use Illuminate\\Database\\Eloquent\\Model;

        class Get{$name}DetailsUseCase extends Base{$name}UseCase
        {
            public function execute(\$data): Model|Builder|string
            {
                return \$this->{$varName}Repository->get{$name}Details(\$data);
            }
        }
        CONTENT;

    }
    protected function getCreateUseCaseStub(string $name, string $module): string
    {
        $varName = lcfirst($name);

        return <<<CONTENT
        <?php

        namespace App\\Application\\UseCases\\$module\\{$name};

        use Illuminate\\Database\\Eloquent\\Builder;
        use Illuminate\\Database\\Eloquent\\Model;

        class Create{$name}UseCase extends Base{$name}UseCase
        {
            public function execute(\$data): Model|Builder|string
            {
                return \$this->{$varName}Repository->save{$name}(\$data);
            }
        }
        CONTENT;

    }

    protected function getUpdateUseCaseStub(string $name, string $module): string
    {
        $varName = lcfirst($name);

        return <<<CONTENT
        <?php

        namespace App\\Application\\UseCases\\$module\\{$name};

        use Illuminate\\Database\\Eloquent\\Builder;
        use Illuminate\\Database\\Eloquent\\Model;

        class Update{$name}UseCase extends Base{$name}UseCase
        {
            public function execute(\$data): Model|Builder|string
            {
                return \$this->{$varName}Repository->update{$name}(\$data);
            }
        }
        CONTENT;

    }

    protected function getDeleteUseCaseStub(string $name, string $module): string
    {
        $varName = lcfirst($name);

        return <<<CONTENT
        <?php

        namespace App\\Application\\UseCases\\$module\\{$name};

        class Delete{$name}UseCase extends Base{$name}UseCase
        {
            public function execute(\$data): void
            {
                \$this->{$varName}Repository->delete{$name}(\$data);
            }
        }
        CONTENT;

    }
}
