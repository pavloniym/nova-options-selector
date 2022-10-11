import FormField from './components/FormField';
import IndexField from './components/IndexField';
import DetailField from './components/DetailField';

Nova.booting((app, store) => {
    app.component('form-options-selector', FormField);
    app.component('index-options-selector', IndexField);
    app.component('detail-options-selector', DetailField);
});
