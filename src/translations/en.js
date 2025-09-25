import coreTranslations from 'ckeditor5/translations/en.js';
import nvboxTranslations from '@nukeviet/ckeditor5-nvbox/translations/en.js';
import nvmediaTranslations from '@nukeviet/ckeditor5-nvmedia/translations/en.js';
import nviframeTranslations from '@nukeviet/ckeditor5-nviframe/translations/en.js';
import nvdocsTranslations from '@nukeviet/ckeditor5-nvdocs/translations/en.js';
import nvtoolsTranslations from '@nukeviet/ckeditor5-nvtools/translations/en.js';

import { mergeTranslations } from '../utils/mergeTranslations.js';

window.CKEDITOR_TRANSLATIONS = mergeTranslations(
  coreTranslations,
  nvboxTranslations,
  nvmediaTranslations,
  nviframeTranslations,
  nvdocsTranslations,
  nvtoolsTranslations
);
