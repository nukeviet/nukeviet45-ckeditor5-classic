import coreTranslations from 'ckeditor5/translations/en.js';
import nvboxTranslations from '@nukeviet/ckeditor5-nvbox/translations/en.js';
import nvmediaTranslations from '@nukeviet/ckeditor5-nvmedia/translations/en.js';

import { mergeTranslations } from '../utils/mergeTranslations.js';

window.CKEDITOR_TRANSLATIONS = mergeTranslations(
  coreTranslations,
  nvboxTranslations,
  nvmediaTranslations
);
