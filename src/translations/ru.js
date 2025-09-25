import coreTranslations from 'ckeditor5/translations/ru.js';
import nvboxTranslations from '@nukeviet/ckeditor5-nvbox/translations/ru.js';
import nvmediaTranslations from '@nukeviet/ckeditor5-nvmedia/translations/ru.js';
import nviframeTranslations from '@nukeviet/ckeditor5-nviframe/translations/ru.js';
import nvdocsTranslations from '@nukeviet/ckeditor5-nvdocs/translations/ru.js';
import nvtoolsTranslations from '@nukeviet/ckeditor5-nvtools/translations/ru.js';

import { mergeTranslations } from '../utils/mergeTranslations.js';

window.CKEDITOR_TRANSLATIONS = mergeTranslations(
  coreTranslations,
  nvboxTranslations,
  nvmediaTranslations,
  nviframeTranslations,
  nvdocsTranslations,
  nvtoolsTranslations
);
