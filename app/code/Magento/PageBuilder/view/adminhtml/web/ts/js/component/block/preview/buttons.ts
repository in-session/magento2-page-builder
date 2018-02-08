/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

import createBlock from "../../block/factory";
import Config from "../../config";
import PreviewBlock from "./block";

export default class Buttons extends PreviewBlock {
    public addButton() {
        const createBlockParams = [
            Config.getInitConfig("contentTypes")["button-item"],
            this.parent,
            this.stage,
            {},
        ];
        createBlock(...createBlockParams).then((button: any) => {
            this.addChild(button);
            button.edit.open();
        });
    }
}
