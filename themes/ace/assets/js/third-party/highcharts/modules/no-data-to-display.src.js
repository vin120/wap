�}�� 
   �uc�L�qw
��I�:��,�ֵv&���u}��Z���x�ok�������e��*�xZ_͑zxN9����D+��1@��G�N��5�^[d���(�c�|Ez�?E\���=��ִ36�DX�p��.&���I�MHgɔ�\@��;i���2=�J�MN�F�7-����\��r�%t|*䲇�`�)�?�W���`N��=�����o����"`\����l��&T^;@�CyHl��o]��U��}0�|�ɚkK!�.���B�n�U��<���W�BT��Ù^ZsD�ZQZ�?����6Wz�k8xϣ���������!�{�=0*���TML��qT�Q��xp	�����A�SR$3�n�!ʋi������=sh��y�h���Ԑ�!�ZR�>G�X���O͏!ኌ��E{��P(�ʰ?@�,C� G Q_(�i��f�ay����&&[����vKCƱ-pk:� �r+�!��::�)9�a�7@������9�>l�,na](k��Ϋ�)����:�lkTR��X�q)~���\�g�G��<I��.V���օʃ��)74�+|�g��'�PXpU��$F`Fф\�է������'!�^qd��m:����Y�
���ra��btA
[W�.�,�l\y�=�{��'�^1�s��Um�P���-��,�v�c:�mx	WL��9��b9�tF�^t��"pn[oB'Y����L&-��Uͳ�Q�}�M:�&u �">/�*cH<Sn�\��%���[�����F���җ�-o���k��m��#��Tm~�XLC�������&@����9bO��b�3���-Pt�g�����Mіq����2w���ṋ�Qތ�&�`/)U�-p0�N��a�2 ��%byr�DXl��w	˭���4��4����u�_��ޑR��t�\��6'�>�Q�=)1�^���Qy��buj
����aM�vhJ�L\Mg���㰵Tڇ�RA\�W�Sf�_M��Y?c���CH�HNl�<F���mD��lA�Y��E���Z����y��es�Z�7�����X�h�@M��"�w�A�3 �o�c�dZa<�9����1�p�#��"��S,�J��O\���m����e�������[��L!�Op�yǋ���5��78�b��Wc�3u��I����g�׾���s7�B���I����^'{Bx%�bn�Y��'bl�Q$k tm�x����Gq�O̹n��o?�չT1���[�YH[��J��R3h���;>
��H�E(s=��=��~:�*�^>?�]O��oMY�6�W`?�x�
6��rI��� <�3���l������gr_��8E̔f����p�)(3����!�>a'�e�O��g���m�jE��L�dᇒ�y�?�ˊe���IQ��_���>����L�j�����]p��S�@���4>fm��������0���K�sb������)�⇼^��Q����`��A=ςg|���b�f�TM#�slD%T���׾D�Q�/h��M�8������4��.D�aԟ4����e�KEx��2�Kb\��`7r�3N;-D�D�r��4�^l�Aeܯ�����9 WSi=>S�BtTc��z�X_	��(�?��b������i`9�"���\K��CW@��F:���P�e�W�A{�/�Of
0�!��IP��'���6zً{��;|�*����5�d�;O@��D0W�e{�7�f�?,g�����Ǚ p�ӞJ�����`����=E�E䪓�R�V�8�*��@��$��n8��b�[o��7���>�Z#�Zk�9?���b��`�`)X�cS'DLj���&fȵ>|pRY���ؗ���&�&��'S{�VC�&��X~����h�s��c�����1W��(�W� Ee�]oH��}f�TK�]�!��c���͕�V�D��}m�">�YI�Zl��UT�����
{����w���O�%k?;+��r�S��+i>�^zR�lD)�E�tP�X1�O�J:�̕Re��g�L�CP�0����:j�*0�@:��n��9.��9��x��nUo������oc�ij*��(2rog��>���ۖ����W�SM�cܳ��
�oꞵ�(� �����?���}�߯?EV��(Z�Z!�C����o*-�J.��Tة�os]*��S#���\e����.ˆ�0���V�������q��.�V��gGʿ�o�L�?j&y��p/��Ӱ[�x���@�u`��U�>�Fo��ցx�\s [�t��/����|�̫8:>R��Β��KR4�ھ�3�rY[w>D#�T��/g���C�b�#�^��ǴvT�FXa���6A��*����莿,�C��i�e���Zs����5X���|Ǎ	�ц�)�w{<�i
=�>���]]jc<Ys:!��j���Y)ӷ�<Z}���Y���h�~.�M\���,I�����hlP3�K
0�a�\�L�,�p�ڋ��Jsight. Otherwise, hide it.
	 */
	function handleNoData() {
		var chart = this;
		if (chart.hasData()) {
			chart.hideNoData();
		} else {
			chart.showNoData();
		}
	}

	/**
	 * Add event listener to handle automatic display of no-data message
	 */
	chartPrototype.callbacks.push(function (chart) {
		H.addEvent(chart, 'load', handleNoData);
		H.addEvent(chart, 'redraw', handleNoData);
	});

}(Highcharts));
