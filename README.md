# Leitor Google Drive
Essa biblioteca visa facilitar a leitura de pastas, documento de texto e planilhas do Google Drive.

## Primeiros passos

### Pré requisitos
* Ter um servidor web com PHP 7.3
* Ter instalado  o Composer, gerenciador de dependências do PHP.

### Instalação
* Copiar o projeto do repositório
* Executar o comando abaixo para copiar as dependências do projeto:
~~~bash
php composer update
~~~

###  Configuração
1. Criar um projeto no [Google Cloud Plataform](https://console.cloud.google.com/home/dashboard)
2. Em [APIs e Serviços](https://console.cloud.google.com/apis/dashboard), ativar as APIs:
> * Google Drive API
> * Google Sheets API
> * Google Docs API
3. Em [Credenciais](https://console.cloud.google.com/apis/credentials), criar inicialmente uma conta de serviço. Em seguida criar uma chave de API para essa conta.
4. Baixar o arquivo JSON de credenciais e salva-lo na pasta credentials com o nome *** credential.json ***

## Funcionalidades

### Google Drive
* *** getFolderContent(string $folderId, string $mimeType=null): Array() *** - Lista os arquivos de uma pasta, conforme o id passado, podendo-se exibir somente pastas, ou determinado tipo de aquivo, de acordo com o mimeType passado.
* *** getFolderContentJson(string $folderId, string $mimeType=null): string *** - Idém ao anterior, mas retornando a lista como um JSON.
* *** identify(string $contentId): Array() *** - Lista as informações de um dado arquivo ou pasta.

### Google Docs
* *** readDoc(string $documentId): Array() *** - Exibe o texto escrito em cada parâgrafo ou tabela do documento.
*_Atualmente essa feature não exibe imagens, listas e outras formas de conteúdo do documento_*
* *** getDocJson(string $documentId): string *** - Idém ao anterior, mas retornando a lista como um JSON.

### Google SpreadSheets
* *** readSheet(string $spreadSheetId, string|Array $ranges, boolean $likeColumns=true): Array() *** - Lista o conteúdo de uma GoogleSpreadSheet conforme o id passado. É necessário também especificar uma(string) ou mais(array) páginas com o intervalo de células a serem lidas. O parâmetro likeColumn indica se as planilhas virão organizadas por colunas ou por linhas.
* *** getSpreadSheetJson(string $spreadSheetId, string|Array $ranges, boolean $likeColumns=true): Array() *** - Idém ao anterior, mas retornando a lista como um JSON.

