<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<h2 align="center">Prueba Técnica - Laravel + GraphQL (Arquitectura Hexagonal, DDD, SOLID)</h2>

<hr>

<h2>🚀 Descripción</h2>

<p>Este proyecto es una prueba técnica realizada en <strong>Laravel</strong> con <strong>GraphQL</strong> utilizando el paquete <a href="https://lighthouse-php.com/">Nuwave Lighthouse</a>, aplicando <strong>arquitectura hexagonal (puertos y adaptadores)</strong>, <strong>DDD</strong>, y principios <strong>SOLID</strong> para máxima mantenibilidad y buenas prácticas.</p>

<p>Permite gestionar productos y categorías, con relaciones y operaciones CRUD (crear, actualizar, eliminar, listar).</p>

<hr>

<h2>📚 Estructura y arquitectura</h2>

<ul>
  <li><strong>App\Application</strong>: Lógica de negocio y servicios.</li>
  <li><strong>App\Domain</strong>: Entidades, repositorios (interfaces) y value objects.</li>
  <li><strong>App\Infrastructure</strong>: Repositorios concretos, modelos Eloquent, mapeo a entidades.</li>
  <li><strong>App\GraphQL</strong>: Resolvers (Mutations y Queries) para GraphQL.</li>
  <li><strong>Tests</strong>: Pruebas unitarias y de integración.</li>
</ul>

<p><strong>Patrones usados:</strong><br>
Arquitectura hexagonal, DDD, principios SOLID, Value Objects, Repository Pattern.</p>

<hr>

<h2>🛠️ Instalación y configuración rápida</h2>

<ol>
  <li><strong>Clona el repositorio:</strong>
    <pre><code>git clone &lt;https://github.com/oscarfiscal/products.git &gt;
cd products</code></pre>
  </li>
  <li><strong>Instala dependencias:</strong>
    <pre><code>composer install</code></pre>
  </li>
  <li><strong>Copia el archivo de entorno y configura tu DB:</strong>
    <pre><code>cp .env.example .env
# Edita .env con tus datos de base de datos</code></pre>
  </li>
  <li><strong>Genera la clave de la app:</strong>
    <pre><code>php artisan key:generate</code></pre>
  </li>
  <li><strong>Ejecuta migraciones y seeders:</strong>
    <pre><code>php artisan migrate --seed</code></pre>
  </li>
  <li><strong>Arranca el servidor:</strong>
    <pre><code>php artisan serve</code></pre>
  
  </li>
</ol>

<hr>

<h2>🧪 Pruebas unitarias y de feature</h2>

<p>Ejecuta los tests con:</p>

<pre><code>php artisan test</code></pre>

<p>Encontrarás tests:</p>
<ul>
  <li>Unitarios en: <code>tests/Unit/Application/Services</code></li>
  <li>Feature (GraphQL): <code>tests/Feature/GraphQL</code></li>
</ul>

<hr>

<h2>🧩 Esquema GraphQL implementado</h2>

<h3>Mutations</h3>
<ul>
  <li><code>createProduct(input: CreateProductInput!): Product</code></li>
  <li><code>updateProduct(id: ID!, input: UpdateProductInput!): Product</code></li>
  <li><code>deleteProduct(id: ID!): Boolean</code></li>
  <li><code>createCategory(input: CreateCategoryInput!): Category</code></li>
  <li><code>updateCategory(id: ID!, input: UpdateCategoryInput!): Category</code></li>
</ul>

<h3>Queries</h3>
<ul>
  <li><code>products: [Product!]!</code> (Listar productos con su categoría)</li>
  <li><code>categories: [Category!]!</code> (Listar categorías con sus productos)</li>
</ul>

<p>Consulta el archivo <code>schema.graphql</code> para los detalles de los tipos y relaciones.</p>

<hr>

<h2>🧑‍💻 Probar la API con Postman</h2>

<p>Se incluye la colección <code>Prueba_Tecnica_Laravel_GraphQL.postman_collection.json</code> en la raíz del proyecto.</p>

<h3>Importar la colección</h3>
<p>Abre Postman → Archivo → Importar → Selecciona el JSON.</p>

<h3>Configuración</h3>
<ul>
  <li><strong>URL:</strong> <code>http://localhost:8083/ o el puerto que estes usando graphql</code></li>
  <li><strong>Headers:</strong> <code>Content-Type: application/json</code></li>
  <li><strong>Método:</strong> <code>POST</code></li>
</ul>

<h3>Ejemplos:</h3>

<p><strong>Crear producto</strong></p>
<pre><code>{
  "query": "mutation { createProduct(input: { name: \"Producto test\", description: \"Desc test\", price: 15.5, category_id: 1 }) { id name price description category { id name } } }"
}</code></pre>

<p><strong>Listar productos</strong></p>
<pre><code>{
  "query": "query { products { id name price description category { id name } } }"
}</code></pre>

<p><strong>Actualizar producto</strong></p>
<pre><code>{
  "query": "mutation { updateProduct(id: 1, input: { name: \"Producto actualizado\" }) { id name description price category { id name } } }"
}</code></pre>

<p><strong>Eliminar producto</strong></p>
<pre><code>{
  "query": "mutation { deleteProduct(id: 1) }"
}</code></pre>

<p><strong>Crear categoría</strong></p>
<pre><code>{
  "query": "mutation { createCategory(input: { name: \"Nueva Categoría\" }) { id name } }"
}</code></pre>

<p><strong>Actualizar categoría</strong></p>
<pre><code>{
  "query": "mutation { updateCategory(id: 1, input: { name: \"Categoría actualizada\" }) { id name } }"
}</code></pre>

<p><strong>Listar categorías con productos</strong></p>
<pre><code>{
  "query": "query { categories { id name products { id name price } } }"
}</code></pre>

<hr>

<h2>🧠 Notas técnicas</h2>

<ul>
  <li><strong>Arquitectura:</strong> hexagonal (puertos y adaptadores), separación de capas (Domain, Application, Infrastructure).</li>
  <li><strong>Buenas prácticas:</strong> SOLID, DDD, Value Objects, uso de repository pattern.</li>
  <li><strong>Cobertura de pruebas:</strong> Unitarias (servicios), feature tests para mutations GraphQL.</li>
</ul>

<hr>

<h2>📂 Otros</h2>

<ul>
  <li><strong>Laravel:</strong> v12</li>
  <li><strong>PHP:</strong> &gt;=8.2</li>
  <li><strong>Lighthouse:</strong> v6.60</li>
  <li><strong>Base de datos:</strong> MySQL (ajusta <code>.env</code> según tu entorno)</li>
</ul>

<hr>

<h2>🤝 Autor</h2>

<p>Desarrollado por <strong>Óscar Fiscal</strong> como parte de un proceso de evaluación técnica.</p>
