import coreTranslations from 'ckeditor5/translations/fr.js';
import nvboxTranslations from '@nukeviet/ckeditor5-nvbox/translations/fr.js';
import nvmediaTranslations from '@nukeviet/ckeditor5-nvmedia/translations/fr.js';
import nviframeTranslations from '@nukeviet/ckeditor5-nviframe/translations/fr.js';

import { mergeTranslations } from '../utils/mergeTranslations.js';

window.CKEDITOR_TRANSLATIONS = mergeTranslations(
  coreTranslations,
  nvboxTranslations,
  nvmediaTranslations,
  nviframeTranslations
);
