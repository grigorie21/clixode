import Index from './Components/Index.vue';
import ImageBuckets from './Pages/ImageBuckets';
// import ImageBuckets from './Pages/FileBucket/Index';
import ImageBucketEdit from './Pages/ImageBucketEdit';
import FileBucketIndex from './Pages/FileBucket/Index';
import FileBucketEdit from './Pages/FileBucket/Edit';
import FileIndex from './Pages/File/Index';
import FileEdit from './Pages/File/Edit';

// import ImageBucketEdit from './Pages/ImageBucketEdit';

// import IndexTable from './components/IndexTable'
// import UntreatedLoadingIndex from './pages/untreated/loading/index'
// import Page1 from './components/Page1'
// import UntreatedLoadingEdit from './pages/untreated/loading/edit'
// import ProductIndex from './pages/product/index'

const routes = [
    {path: '/', name: 'index', component: Index},
    {path: '/image-buckets', name: 'image-buckets', component: ImageBuckets},
    {path: '/image-buckets/:id', name: 'image-buckets.edit', component: ImageBucketEdit},

    {path: '/file-buckets', name: 'file-buckets', component: FileBucketIndex},
    {path: '/file-buckets/:id', name: 'file-buckets.edit', component: FileBucketEdit},

    {path: '/file', name: 'file', component: FileIndex},
    {path: '/file/:id', name: 'file.edit', component: FileEdit},

    // {path: '/loading', name: 'loading.index', component: UntreatedLoadingIndex},
    // {path: '/loading/:id', name: 'loading.edit', component: UntreatedLoadingEdit},
    // {path: '/page1', name: 'page1', component: Page1},
    // {path: '/product', name: 'product.index', component: ProductIndex},
];

export default routes;

