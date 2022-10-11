import IndexField from './components/IndexField';
import DetailField from './components/DetailField';
import FormField from './components/FormField';

Nova.booting((app, store) => {
  app.component('index-options-selector', IndexField);
  app.component('detail-options-selector', DetailField);
  app.component('form-options-selector', FormField);
});
