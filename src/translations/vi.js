import coreTranslations from 'ckeditor5/translations/vi.js';
import nvboxTranslations from '@nukeviet/ckeditor5-nvbox/translations/vi.js';
import nvmediaTranslations from '@nukeviet/ckeditor5-nvmedia/translations/vi.js';
import nviframeTranslations from '@nukeviet/ckeditor5-nviframe/translations/vi.js';
import nvdocsTranslations from '@nukeviet/ckeditor5-nvdocs/translations/vi.js';
import nvtoolsTranslations from '@nukeviet/ckeditor5-nvtools/translations/vi.js';


import { mergeTranslations } from '../utils/mergeTranslations.js';

window.CKEDITOR_TRANSLATIONS = mergeTranslations(
  coreTranslations,
  nvboxTranslations,
  nvmediaTranslations,
  nviframeTranslations,
  nvdocsTranslations,
  nvtoolsTranslations
);
