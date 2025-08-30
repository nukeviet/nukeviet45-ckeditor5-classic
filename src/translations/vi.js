import coreTranslations from 'ckeditor5/translations/vi.js';
import nvboxTranslations from '@nukeviet/ckeditor5-nvbox/translations/vi.js';
import nvmediaTranslations from '@nukeviet/ckeditor5-nvmedia/translations/vi.js';

import { mergeTranslations } from '../utils/mergeTranslations.js';

window.CKEDITOR_TRANSLATIONS = mergeTranslations(
  coreTranslations,
  nvboxTranslations,
  nvmediaTranslations
);
